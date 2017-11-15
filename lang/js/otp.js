// used for OTP things

$(document).ready(function(){

	$("#newPhoneDiv").submit(function(){

		if( document.forms["newPhone"]["phone_no"].value.length != 10 )
		{
			messageBox("Please enter a valid 10 digit number", "#c0392b");
			return false;
		}
		else
			useOtp = 1;

		$(".newPhoneDiv input[name='phone_no']").hide();
		$(".newPhoneDiv input[name='otp']").fadeIn();
		$(".newPhoneDiv button[type='submit']").hide();
		$(".newPhoneDiv .verifyDiscription").fadeIn();
		return false;
	});

});