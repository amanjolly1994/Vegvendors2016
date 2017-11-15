$(document).ready(function(){



	// All Global Variables

	var tunnel = 0; // 0 = Closed. 1 = Open (Side Tunnel)


	$(".delivery-main-button").click(function(){

		var main_option = $('input[name=delivery-main-option]:checked').val();

		if( $('input[name=slot-selection]').is(':checked') )
		{
			var slot_option = $('input[name=slot-selection]:checked').val();
			save_slot_session(slot_option);
		}

		else if( main_option == 98 )
		{
			$(".delivery-main").hide();
			$(".slot-main").fadeIn();
		}

		else if( main_option == 99 )
		{
			save_slot_session(99);
		}

	});

	$(".slot-back").click(function(){
		$(".slot-main").hide();
		$(".delivery-main").fadeIn();
	});

	// load basket into tunnel
	// AUto Loads
	(function loadBasket(){
		// $(".tunnel-row-2").load("basket.php #basket");
		$(".tunnel-row-1").load("index.php #tunnel-account")
	}());

	// Click inner Functions

	$(".box-category-heading").click(function(){
		$(".catMenu").slideToggle();
	});

	$(".search-tab").click(function(){
		$(".my-account-tab, .cart-tab, .search-tab").hide();
		$(".search-div").fadeIn();
		$(".search-in-head").focus();
	});

	$(".close-search").click(function(){
		$(".searchBox").slideUp();
	});



	// Side Tunnel Opening

	$(".cart-tab").click(function(){

		window.location.href = "/basket";
		// $(".mainPage").css({left: '-400px', opacity: '0.5'});
		// $(".tunnel").css({right: '0px'});
		// $('html, body').css({
		//     'overflow-y': 'hidden'
		// });
	});


	$(".my-account-tab").click(function(){
		$(".mainPage").css({left: '-400px', opacity: '0.5'});
		$(".tunnel").css({right: '0px'});
		$(".tunnel-row-1").load("index.php #tunnel-account");
	});

	$(".tunnel-row-1").on("click", ".tunnel-account-menu li:first-child", function(){
		$(".tunnel-row-1").html("<div class='iframeContainer'><iframe src='/iframeLog' marginwidth='0' marginheight='0' seamless='seamless' allowtransparency='true' height='100%' frameborder='0'width='100%'></iframe></div>");
	});

	$(".tunnel-row-1").on("click", ".tunnel-account-menu li:last-child", function(){
		$(".tunnel-row-1").html("<div class='iframeContainer'><iframe id='tunnel-iframe' src='/iframeLog' marginwidth='0' marginheight='0' seamless='seamless' allowtransparency='true' height='100%' frameborder='0'width='100%'></iframe></div>");
		$("#tunnel-iframe").contents().find("#iframeLogin").hide();
		$("#tunnel-iframe").contents().find("#iframeSignup").show();
	});

	$(".head-loc-clickable").click(function(){
		$(".mainPage").css({left: '-400px', opacity: '0.5'});
		$(".tunnel").css({right: '0px'});
		$(".tunnel-row-1").load("login.php #loginBox", function(){
			$(".form-group").css({fontFamily: 'roboto', fontSize: '16px', color: '#424242', width: '100%', marginTop: '10px', marginLeft: '0px'});
			$(".selectpicker").css({width: '200px', padding: '5px 10px', cursor: 'pointer'});
		});
		return false;
	});

	$(".changeSignup").click(function(){
		$(".againLocation").removeClass("active");
		$(".changeLogin").removeClass("active");
		$(".changeSignup").addClass("active");
		$("#location").hide();
		$("#login").hide();
		$("#signUp").fadeIn();
		return false;
	});

	$(".againLocation").click(function(){
		$(".againLocation").addClass("active");
		$(".changeLogin").removeClass("active");
		$(".changeSignup").removeClass("active");
		$("#location").fadeIn();
		$("#login").hide();
		$("#signUp").hide();
		return false;
	});

	$(".tunnel-row-1").on("click", ".changeSignup", function(){
		$("#location").hide();
		$("#login").hide();
		$("#signUp").fadeIn();
		return false;
	});

	$(".changeLogin").click(function(){
		$(".againLocation").removeClass("active");
		$(".changeLogin").addClass("active");
		$(".changeSignup").removeClass("active");
		$("#location").hide();
		$("#login").fadeIn();
		$("#signUp").hide();
		return false;
	});

	$(".tunnel-row-1").on("click", ".changeLogin", function(){
		$("#location").hide();
		$("#login").fadeIn();
		$("#signUp").hide();
		return false;
	});

	$(".tunnel-arrow").click(function(){
		$(".mainPage").css({left: '0px', opacity: '1'});
		$(".tunnel").css({right: '-400px'});
			// $('html, body').css({
			//     'overflow-y': 'auto'
			// });
	});

	$(".basket").on("click", ".checkout-button", function(event){
		event.preventDefault();
		if( $(".totalItems").val() == 0 )
			return false;
		else
			return true;

	});

	// $(".tunnel-row-2").on("click", ".checkout-button", function(event){
	// 	if( $(".totalItems").val() == 0 )
	// 	{
	// 		event.preventDefault();
	// 		window.location.href = "/basket.php";
	// 	}
	//
	// });

	$(".fullBasketDiv").on("click", ".changeVendorBasket", function(event){
		event.preventDefault();
		$(".mainPage").css({left: '-400px', opacity: '0.5'});
		$(".tunnel").css({right: '0px'});

		var vegName = $(this).attr("current-sabzi");

		console.log(vegName);

		$(".tunnel-row-1").load("changeVendor.php?cat="+vegName+" #changeVendorDiv", function(){

		});
	});

	//address box function in checkout page

	$(".address-form-input").blur(function(event){
		event.preventDefault();
		var temp_add = $(".address-form-input").val();
		if( temp_add == "" || temp_add == null || temp_add.length < 8 )
		{
			messageBox("Address cannot be so small or empty. Fill it.", "rgb(192, 57, 43)");
			$(".address-loading").html("");
			return false;
		}
		ajaxUpdate();
		return false;
	});

	// Closing Side tunnel when anything outside is clicked

	$(document).click(function(e){

		if( e.target.className != 'search-div' && !$('.search-div').find(e.target).length && e.target.className != 'search-tab' && !$('.search-tab').find(e.target).length )
		{
			$(".my-account-tab, .cart-tab, .search-tab").fadeIn();
			$(".search-div").hide();
			$(".search-in-head").blur();
		}

		// if( e.target.className != 'size-add' && !$('.size-add').find(e.target).length && e.target.className != 'tunnel' && !$('.tunnel').find(e.target).length && e.target.className != 'cart-tab' && !$('.cart-tab').find(e.target).length && e.target.className != 'my-account-tab' && !$('.my-account-tab').find(e.target).length && e.target.className != 'changeSelectedVendor' && !$('.changeSelectedVendor').find(e.target).length )
		// {
		// 	$(".mainPage").css({left: '0px', opacity: '1'});
		// 	$(".tunnel").css({right: '-400px'});
		// 	// $('html, body').css({
		// 	//     'overflow-y': 'auto'

		// 	// });
		// }

	});

	// Click inner Functions ends

	// Redirect Functions

	// $(".tunnel-row-2").on("click", ".your-basket-text", function(){
	// 	window.location.href = "/basket.php";
	// });

	$(".fullBasketDiv").on("click", ".your-basket-text", function(){
		window.location.href = "#";
	}); //stops redirect to itself when clicked on basket in basket.php


	// Logout Button Work

	$(".loginTopper, .tunnel-row-1").on("click", ".logoutClass", function(){

		window.location = "/lang/phpFiles/logout.php";
		// $.ajax({

		// 	url: '/lang/phpFiles/logout.php',

		// 	beforeSend: function()
		// 	{
		// 		//Logging out Message
		// 	}

		// 	success: function(logInfo){

		// 		if( logInfo==1 )
		// 		{
		// 			//successful
		// 			alert("Logout Successful");
		// 		}

		// 		else
		// 		{
		// 			//Failed
		// 			alert("Failed");
		// 		}

		// 	}

		// });
	});

	// Mobile View Media Query

	var mq = window.matchMedia( "only screen and (min-width:50px) and (max-width:500px)" );

	if( mq.matches )
	{
		document.getElementsByName('search')[0].placeholder='What are you upto?';
	}




	//Settings Tabs

	$(".dashView").on("click", ".settingTabs li", function(e){
		$(".settingTabs li").removeClass("active");
		$(this).addClass("active");
		if( e.target.className=='general-li active' )
		{
			$(".settingContent > div").hide();
			$(".generalContent").fadeIn();
		}

		else if( e.target.className=='pass-li active' )
		{
			$(".settingContent > div").hide();
			$(".changePasswordContent").fadeIn();
		}

		else if( e.target.className=='cont-li active' )
		{
			$(".settingContent > div").hide();
			$(".changeContactContent").fadeIn();
		}
	});

	// OPEN NOTIFICATION WHEN CLICKED ON GHANTI and Others

	$(".notiButton").click(function(){
		$(".dashMenuList li").removeClass("active");
		$(".dashboardTab").addClass("active");
		$(".dashView").html("");
		$(".dashView").load("dashboard.php #notid");
	});

	$(".userBox, .userPic, .menuBigPic").click(function(){
		$(".dashMenuList li").removeClass("active");
		$(".profileTab").addClass("active");
		$(".dashView").html("");
		$(".dashView").load("/dashboard/profile.php #profilePage");
	});



});

// MAKING HEADER FIXED

$(document).scroll(function(){

	if( $(this).scrollTop() > 300 )
	{
		$("nav").addClass("showFixedHeader");
		$("nav").addClass("hasShadow");
		$(".catMenu").hide();
		$("#taskbar").css({marginBottom: '60px'});
		// $(".box-category-heading").css({backgroundColor: '#4caf50', color: '#fff'});
	}

	else
	{
		$("nav").removeClass("showFixedHeader");
		$("nav").removeClass("hasShadow");
		$(".catMenu").hide();
		$("#taskbar").css({marginBottom: '0px'});
		// $(".box-category-heading").css({backgroundColor: 'transparent', color: 'inherit'});
	}

});


//To Create a Message Box and Display a message
function messageBox(messageText, type)
{
		$(".messageBox").fadeIn();

		if( $(".messageBoxWrapper").length ){
			//exists.
		}
		else{
			var messageBoxWrapper = '<div class="messageBoxWrapper"></div>';
			$(".common").append(messageBoxWrapper);
		}

		if( $(".messageBox").length ){
			$(".messageBox").css({background: type});
			$(".messageBox .mls").text(messageText);
		}
		else{
			var messageBox = '<div class="messageBox closeBox"><span class="mls"></span></div>';
			$(".messageBoxWrapper").append(messageBox);


			$(".messageBox").css({background: type});
			$(".messageBox .mls").text(messageText);
		}


		$(".closeBox").click(function(){
			$(this).fadeOut();
		});

		$(".messageBox").delay(2000).fadeOut();

}
