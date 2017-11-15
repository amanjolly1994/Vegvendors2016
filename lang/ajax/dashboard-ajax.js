// Dashboard Change AJAX

$(document).ready(function(){

	var demoVar = 0;

	$(".inSize, .dashView").on("change", "#uploadPhotoBtn", function(){
		$(".removePhoto").val("Save Photo");
		previewImage(this);
	});

	$(".inSize, .dashView").on("submit", "#uppy", function(){
		if( $("#uploadPhotoBtn").val() == null || $("#uploadPhotoBtn").val() == "" )
		{
			messageBox("No Image Selected.", "rgb(192, 57, 43)");
			return false;
		}

	});

	//To preview a selected Image into the box

	function previewImage(input)
	{
		if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.previewHolder').attr('src', e.target.result);
                $('.userPic img').attr('src', e.target.result);
                $('.menuBigPic img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
	}

	//Make Changes to the profile using AJAX

	$(".inSize, .dashView").on("submit", "#editProfile", function(){
		var temp = $(".editUsername").val();
		if( temp == "" || temp == null )
		{
			messageBox("Name cannot be empty. Fill it.", "rgb(192, 57, 43)");
			return false;
		}
		ajaxUpdate("editProfile");
		return false;
	});

	function refreshValues()
	{
		var temp = $(".editUsername").val();
		$(".dashUsername").text(temp);
		$(".my-account-tab .mls").text(temp);
	}

	function ajaxUpdate(current)
	{
		if( current == "editProfile" )
		{
			var meta = $("#editProfile").serialize();
		}
		else if( current == "invoice" )
		{
			var meta = $("#generalForm").serialize();
		}
		else if( current == "password" )
		{
			var meta = $("#changePasswordContent").serialize();
		}


		$.ajax({

			type : 'POST',
			url : '/lang/phpFiles/updateProfile.php',
			data : meta,


			beforeSend : function()
			{
				messageBox("Saving changes. Please wait.", "rgba(52, 73, 94, 0.7)");
			},

			success : function(value)
			{
				if(value=="done")
				{
					refreshValues();
					messageBox("Profile Saved.", "rgb(46, 204, 113)");
				}
				else if(value=="not done")
				{
					messageBox("Error. Please try again.", "rgb(192, 57, 43)");
				}
			}

		});

	}

	$(".inSize, .dashView").on("submit", "#generalForm", function(){

		ajaxUpdate("invoice");
		return false;

	});

	$(".inSize, .dashView").on("submit", "#changePasswordContent", function(){

		//Validation for password change
		var current = document.forms["changePasswordForm"]["currentPassword"].value;
		var newPass = document.forms["changePasswordForm"]["newPassword"].value;
		var rePass = document.forms["changePasswordForm"]["rePassword"].value;

		if( current == "" || current == null)
		{
			messageBox("Please enter your current password.", "rgb(192, 57, 43)");
			return false;
		}

		else if( newPass == "" || newPass == null )
		{
			messageBox("Please enter a new password.","rgb(192, 57, 43)");
			return false;
		}

		else if( rePass == "" || rePass == null )
		{
			messageBox("Please re-type your password to confirm.","rgb(192, 57, 43)");
			return false;
		}

		if( newPass.length < 8 )
		{
			messageBox("Password cannot be less than 8 characters.","rgb(192, 57, 43)");
			return false;
		}

		if( newPass != rePass )
		{
			messageBox("Password doesnt match. Please re-try.","rgb(192, 57, 43)");
			return false;
		}

		ajaxPasswordUpdate();
		return false;

	});

	function ajaxPasswordUpdate()
	{
		var pass = $("#changePasswordForm").serialize();

		$.ajax({

			type : 'POST',
			url : '/lang/phpFiles/passwordUpdate.php',
			data : pass,

			beforeSend : function() {
				messageBox("Checking your password","rgba(52, 73, 94, 0.7)");
			},

			success : function(val) {

				if( val == "done" )
				{
					messageBox("Done. Password updated.", "rgb(46, 204, 113)");
				}

				else if( val == "wrong" )
				{
					messageBox("Invalid password. Try again.", "rgb(192, 57, 43)");
				}

				else
				{
					messageBox("Some other Problem. Try again.","rgb(192, 57, 43)");
				}

			}

		});
	}

	$(".inSize, .dashView, .checkoutDiv").on("submit", "#changeContactForm", function(){

		var phone_no = document.forms["changeContactForm"]["newPhone"].value;

		var test_phone = /^\d{10}$/;

		if( !phone_no.match(test_phone) )
		{
			messageBox("Please enter a valid 10 digit number.","#e74c3c");
			return false;
		}
		else{

			ajaxSendOtp();
			return false;
		}

	});

	function ajaxSendOtp()
	{

		var phone = $("#changeContactForm").serialize();

		$.ajax({

			type : 'POST',
			url : '/lang/phpFiles/sendOtp.php',
			data : phone,

			beforeSend : function(){
				messageBox("Sending OTP to your phone","rgba(52, 73, 94, 0.7)");
			},

			success : function(req)
			{
				if( req == "ok" )
				{
					messageBox("OTP has been sent to your phone.", "#2ecc71");
					$(".otpCheckButton").removeAttr("disabled");
					$(".otpCheckButton").removeClass("disabledButton");
					$(".otpCheckButton").addClass("allowedButton");
				}

				else{
					console.log(req);
					messageBox("OTP cannot be sent. Try again.","#e74c3c");
				}
			}

		});

	}


	//confirm otp

	$(".inSize, .dashView, .checkoutDiv").on("submit", ".confirmPhone", function(event){

		event.preventDefault();
		var otp = document.forms["confirmPhone"]["otp"].value;
		var test_otp = /^\d{5}$/;

		if( !otp.match(test_otp) )
		{
			messageBox("Please enter a valid OTP number.","#e74c3c");
			return false;
		}

		else{
			ajaxOtpCheck();
			return false;
		}

	});

	function ajaxOtpCheck()
	{
		var otp = $(".confirmPhone").serialize();

		$.ajax({

			type: 'POST',
			url : '/lang/phpFiles/checkOtp.php',
			data : otp,

			beforeSend: function(){
				messageBox("Please wait while we check your otp.","rgba(52, 73, 94, 0.7)");
			},

			success: function(req)
			{
				if( req == "OK" )
				{
					messageBox("New phone number has been saved.", "#2ecc71");
					$(".confirmPhone")[0].reset();
				}
				else if( req == "not" )
				{
					messageBox("Problem occured while updating phone number.","rgba(52, 73, 94, 0.7)");
				}
				else
				{
					messageBox("OTP entered is incorrect. Try again.","rgba(52, 73, 94, 0.7)");
				}
			}

		});
	}

});	// Ready Function CLosed
