//JS for canvas display
//checkout page canvas
var total = 0;
$(document).ready(function() {

  var newPhoneVar = "11";

  $(".checkout-address-box").on('click','.checkout-change-address',function(event){
    event.preventDefault();

    console.log("address change");
    $(".canvas-content").empty();
    var $canvasCloseButton = '<button class="canvas-close-button">x</button>';
    var $canvasIcon = '<div class="canvas-icon-holder"><img src="/theme/images/icons/1484245305_Home.png" /></div>';
    var $canvasHeading = '<div class="canvas-heading"><h4>Please Enter Delivery Address</h4></div>';

    var $canvasAddressForm = '<form class="canvas-work-holder canvas-address-form"><input type="text" placeholder="Enter address for the selected location" class="checkout-address-input" /><input type="submit" value="Save Address" class="checkout-save-address" /></form>';
    var $canvasFoot = '<div class="canvas-foot">You are shopping from: <span class="mls">FU Block, Pitampura</span></div>';
    $(".canvas-content").append($canvasCloseButton,$canvasIcon,$canvasHeading,$canvasAddressForm,$canvasFoot);
    $(".checkout-address-input").attr('placeholder', 'Enter your address for '+currentLocation);
    $(".canvas-foot .mls").html(currentLocation);
    $(".canvas-content").width(500);
    $(".canvas-box-holder").fadeIn();

  });

  $(document).click(function(e){

    if( e.target.className == 'canvas-box-holder' || e.target.className == 'canvas-close-button' )
    {
      $(".canvas-box-holder").fadeOut();
    }

  });

  $(".canvas-content").on('submit', '.canvas-address-form', function(event) {
    event.preventDefault();
    var newAddress = $(".checkout-address-input").val();
    if( newAddress.length > 8 )
      changeAddress(newAddress);
    else {
      $(".canvas-work-holder").append('<p class="canvas-warning-text">Address must be of 8 letters atleast.</p>');
    }
    return false;
  });

  function changeAddress(address)
  {
    var naya = "address-only="+address;

    $.ajax({

      type : 'POST',
      url : '/lang/phpFiles/updateProfile.php',
      data : naya,

      beforeSend : function()
      {
        console.log(naya);
        $(".canvas-content").hide();
        $(".canvas-content").empty();
        var $loadingDiv = '<div class="canvas-loading-div"></div>';
        var $savingAddress = '<div class="address-saving-div"><img src="/theme/images/icons/ring-alt.svg" /><span class="mls">Saving your address...</span></div>';

        $(".canvas-content").append($loadingDiv);
        $(".canvas-loading-div").append($savingAddress);
        $(".canvas-content").fadeIn();
      },

      success : function(value)
      {
        if( value == "done" )
        {
          console.log("done");
          $(".checkout-address-box-right .mls").empty();
          $(".checkout-address-box-right .mls").append(address+", "+currentLocation);

          //$(".change-address-label").html(address);
          setTimeout(function(){ $(".canvas-box-holder").fadeOut(); }, 1200);
        }
        else {
          console.log("Error Occured While saving address.");
        }
      }

    });

  }

  $(".checkout-phone-box").on('click','.checkout-change-phone-button',function(event) {
    console.log("change phone");
    event.preventDefault();
    var test_phone = /^\d{10}$/;

    var phone_cookie = getCookie("new_phone");
    if( phone_cookie != "" )
    {
      directShowOtpForm();
    }
    else {
      $(".canvas-content").empty();
      var $canvasCloseButton = '<button class="canvas-close-button">x</button>';
      var $canvasIcon = '<div class="canvas-icon-holder"><img src="/theme/images/icons/1484265048_sms.png" /></div>';
      var $canvasHeading = '<div class="canvas-heading"><h4>Please Verify Your Phone No.</h4></div>';

      var $canvasFoot = '<div class="canvas-foot">You are shopping from: <span class="mls">FU Block, Pitampura</span></div>';
      var $canvasAddressForm = '<div class="phone-checkout-form-holder"><form class="canvas-work-holder canvas-phone-form"><input type="phone" placeholder="Enter 10 digit Phone no." class="checkout-address-input" /><input type="submit" value="Send OTP" class="checkout-save-address" /></form></div>';
      $(".canvas-content").append($canvasCloseButton,$canvasIcon,$canvasHeading,$canvasAddressForm,$canvasFoot);

      $(".canvas-foot .mls").html(currentLocation);
      $(".canvas-content").width(500);
      $(".canvas-box-holder").fadeIn();
    }

  });

  $(".canvas-content").on('submit', '.canvas-phone-form', function(event) {
    event.preventDefault();
    var newPhone = $(".checkout-address-input").val();
    var test_phone = /^\d{10}$/;

    if( newPhone.match(test_phone) )
    {
      $(".canvas-warning-text").remove();
      phoneCheck(newPhone);
      return false;
    }
    else {
      $(".canvas-work-holder").append('<p class="canvas-warning-text">Please enter a valid 10 digit phone number.</p>');
    }

  });

  function phoneCheck(phone)
  {
    var haya = "newPhone="+phone;

    $.ajax({

      type : 'POST',
      url : '/lang/phpFiles/checkPhone.php',
      data : haya,

      beforeSend : function(){
        console.log("Checking Phone Number");
      },

      success : function(val)
      {
        if(val==1)
          sendPhoneOtp(phone);
        else
          $(".canvas-work-holder").append('<p class="canvas-warning-text">Number is already registered. Please choose another.</p>');
      }

    });
  }

  function sendPhoneOtp(phone)
  {
    var naya = "newPhone="+phone;

    $.ajax({

      type : 'POST',
      url : '/lang/phpFiles/sendOtp.php',
      data : naya,

      beforeSend : function(){
        console.log("Sending OTP");
      },

      success : function(req)
      {
        if( req == "ok" )
        {
          $("canvas-icon-holder img").attr('src', '/theme/images/icons/1484267420_unlock.png');
          $(".phone-checkout-form-holder").empty();

          var $newForm = '<form class="canvas-work-holder canvas-otp-form"><input type="phone" placeholder="Enter OTP recieved on your number" class="checkout-address-input checkout-otp-value" /><input type="submit" value="Verify OTP" class="checkout-save-address" /></form>';

          $(".phone-checkout-form-holder").append($newForm);
          setCookie("new_phone",phone,3);
          $(".canvas-work-holder").append('<p class="canvas-warning-text otp-resend">Please wait for 3 minutes to re-send OTP.</p>');

          var cookie_int = setInterval(function(){
            var phone_cook = getCookie("new_phone");
            if( phone_cook == "" )
            {
              $(".otp-resend").html('Click here to re-send OTP.');
              $(".otp-resend").addClass('rephone-enter');
              clearInterval(cookie_int);
            }
           }, 2000);
        }
        else {
          console.log("Error sending OTP");
        }
      }

    });
  }

  $(".canvas-content").on('submit', '.canvas-otp-form', function(event) {
    event.preventDefault();
    var newOtp = $(".checkout-address-input").val();
    var test_phone = /^\d{5}$/;

    if( newOtp.match(test_phone) )
    {
      $(".canvas-warning-text").remove();
      verifyOtp(newOtp);
      return false;
    }
    else {
      $(".canvas-work-holder").append('<p class="canvas-warning-text">Please enter a valid OTP sent on your number.</p>');
    }

  });

  function verifyOtp(otp)
  {
    var naya = "otp="+otp;

    $.ajax({

      type: 'POST',
      url : '/lang/phpFiles/checkOtp.php',
      data : naya,

      beforeSend: function(){
        console.log(naya);

      },

      success: function(req)
      {
        console.log(req);
        if( req == "OK" )
        {
          $(".canvas-content").hide();
          $(".canvas-content").empty();
          var $loadingDiv = '<div class="canvas-loading-div"></div>';
          var $savingAddress = '<div class="address-saving-div"><img src="/theme/images/icons/ring-alt.svg" /><span class="mls">Saving your Contact Number...</span></div>';

          $(".canvas-content").append($loadingDiv);
          $(".canvas-loading-div").append($savingAddress);
          $(".canvas-content").fadeIn();
          newPhoneVar = getCookie("new_phone");
          $(".checkout-phone-box-right .mls").html(newPhoneVar);
          setTimeout(function(){ $(".canvas-box-holder").fadeOut(); }, 1200);
        }
        else if( req == "not" )
        {
          $(".canvas-work-holder").append('<p class="canvas-warning-text">Problem in Sending OTP. Try Again.</p>');
        }
        else
        {
          $(".canvas-work-holder").append('<p class="canvas-warning-text">OTP entered is Incorrect. Try Again.</p>');
        }
      }

    });
  }

  function directShowOtpForm()
  {
    $(".canvas-content").empty();
    var $canvasCloseButton = '<button class="canvas-close-button">x</button>';
    var $canvasIcon = '<div class="canvas-icon-holder"><img src="/theme/images/icons/1484267420_unlock.png" /></div>';
    var $canvasHeading = '<div class="canvas-heading"><h4>Please Verify Your Phone No.</h4></div>';

    var $canvasFoot = '<div class="canvas-foot">You are shopping from: <span class="mls">FU Block, Pitampura</span></div>';
    var $canvasAddressForm = '<div class="phone-checkout-form-holder"><form class="canvas-work-holder canvas-phone-form"><input type="phone" placeholder="Enter 10 digit Phone no." class="checkout-address-input" /><input type="submit" value="Send OTP" class="checkout-save-address" /></form></div>';
    $(".canvas-content").append($canvasCloseButton,$canvasIcon,$canvasHeading,$canvasAddressForm,$canvasFoot);

    $(".canvas-foot .mls").html(currentLocation);
    $(".canvas-content").width(500);

    $("canvas-icon-holder img").attr('src', '/theme/images/icons/1484267420_unlock.png');
    $(".phone-checkout-form-holder").empty();

    var $newForm = '<form class="canvas-work-holder canvas-otp-form"><input type="phone" placeholder="Enter OTP recieved on your number" class="checkout-address-input checkout-otp-value" /><input type="submit" value="Verify OTP" class="checkout-save-address" /></form>';

    $(".phone-checkout-form-holder").append($newForm);
    $(".canvas-work-holder").append('<p class="canvas-warning-text otp-resend">Please wait for 3 minutes to re-send OTP.</p>');
    $(".canvas-box-holder").fadeIn();

    var cookie_int = setInterval(function(){
      var phone_cook = getCookie("new_phone");
      if( phone_cook == "" )
      {
        $(".otp-resend").html('Click here to re-send OTP.');
        $(".otp-resend").addClass('rephone-enter');
        clearInterval(cookie_int);
      }
    }, 5000);
  }

  $(".canvas-content").on('click', '.rephone-enter',function(event) {
    event.preventDefault();
    console.log("RE SEND OTP");
    $(".canvas-box-holder").hide();
    $(".canvas-content").empty();
    var $canvasCloseButton = '<button class="canvas-close-button">x</button>';
    var $canvasIcon = '<div class="canvas-icon-holder"><img src="/theme/images/icons/1484265048_sms.png" /></div>';
    var $canvasHeading = '<div class="canvas-heading"><h4>Please Verify Your Phone No.</h4></div>';

    var $canvasFoot = '<div class="canvas-foot">You are shopping from: <span class="mls">FU Block, Pitampura</span></div>';
    var $canvasAddressForm = '<div class="phone-checkout-form-holder"><form class="canvas-work-holder canvas-phone-form"><input type="phone" placeholder="Enter 10 digit Phone no." class="checkout-address-input" /><input type="submit" value="Send OTP" class="checkout-save-address" /></form></div>';
    $(".canvas-content").append($canvasCloseButton,$canvasIcon,$canvasHeading,$canvasAddressForm,$canvasFoot);

    $(".canvas-foot .mls").html(currentLocation);
    $(".canvas-content").width(500);
    $(".canvas-box-holder").fadeIn();
  });

  $(".slot-preview").on('click', '.checkout-change-slot .mls', function(event) {
    event.preventDefault();
    console.log("change slot");
    window.location.href="/delivery";
  });

  $(".checkout-coupon-box").on('click', '.checkout-apply-coupon .mls', function(event) {
    event.preventDefault();
    $(".checkout-coupon-form").fadeIn();
  });

  $(".checkout-coupon-form").submit(function(event){
    event.preventDefault();

    var coupon = $(".coupon-code-input").val();

    if( coupon != "" || coupon != null )
    {
      applyCoupon(coupon);
      return false;
    }

  });

  function applyCoupon(coupon)
  {
    var your_cart = [];
  	your_cart = JSON.parse(localStorage.getItem("shoppingCart"));

    for( var i in your_cart )
		{
			total += your_cart[i].price * your_cart[i].count;
		}

    var caya = "coupon="+coupon+"&total="+total;

    $.ajax({

      type : 'POST',
      url : '/lang/phpFiles/applyCoupon.php',
      data : caya,

      beforeSend : function()
      {
        console.log(caya);
        $(".canvas-content").empty();
        var $loadingDiv = '<div class="canvas-loading-div"></div>';
        var $savingAddress = '<div class="address-saving-div"><img src="/theme/images/icons/ring-alt.svg" /><span class="mls">Applying Coupon. Please Wait...</span></div>';

        $(".canvas-content").append($loadingDiv);
        $(".canvas-loading-div").append($savingAddress);
        $(".canvas-content").fadeIn();
        $(".canvas-content").width(500);
        $(".canvas-box-holder").fadeIn();
      },

      success : function(rel)
      {
        setTimeout(function(){ $(".canvas-box-holder").fadeOut(); }, 1000);
        console.log(rel);
        var value = parseFloat(rel);
        if(isNaN(value))
        {
          console.log("Coupon not applied");
          $(".coupon-message .mls").html(rel);
          $(".coupon-message").fadeIn();
        }
        else {
          console.log("Coupon Applied");
          useCoupon(coupon,rel);
        }
      }

    });
  }

  function useCoupon(coupon,newTotal)
  {
    $(".checkout-coupon-box-right .mls").html(coupon);
    $(".checkout-apply-coupon .mls").html("Use Another Coupon");
    $(".checkout-coupon-form").fadeOut();
    $(".coupon-tick").fadeIn();

    $(".old-total-amount .mls").html(total);
    var coupon_value = total - newTotal;
    $(".coupon-discount-value .mls").html(coupon_value);
    $(".discount-box").fadeIn();
    $(".preview-basket-total span").html(newTotal);
  }

  var coupon_code = $(".hidden-coupon-save").val();
  if( coupon_code != "" && coupon_code != null )
  {
    applyCoupon(coupon_code);
  }

});

//w3S Cookie Functions

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
