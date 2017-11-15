// Validation of Registration Form in the login.php page
$(document).ready(function()
{

$("#iframeSignup ,#signUp, .tunnel-row-1").on("submit", "#registrationForm", function(){

	var full_name = document.forms["registrationForm"]["full_name"].value;
	var user_email = document.forms["registrationForm"]["user_email"].value;
	var user_password = document.forms["registrationForm"]["user_password"].value;

	if( full_name.length < 4 )
	{
		alert("full name less than 4");
		return false;
	}

	if( user_password.length < 8 )
	{
		alert("password length can't be less than 8");
		return false;
	}

	ajaxRegistration();

	return false;
});

function ajaxRegistration()
{
	var beta = $("#registrationForm").serialize();

	$.ajax({

	type : 'POST',
	url  : '/lang/phpFiles/register.php',
	data : beta,
	beforeSend: function()
	{
		messageBox("Setting you up. Please wait.","rgba(52, 73, 94, 0.7)");
	},
	success :  function(data)
			   {

					if(data==1){

						messageBox("Sorry, this email is already taken. Try another.","rgb(192, 57, 43)");

					}
					else if(data=="registered")
					{

						setTimeout(messageBox("Done. Logging you in.","rgb(46, 204, 113)"), 2000);
						location.reload();

					}
					else{

						//Not Working .. unknown error

					}
			   }
	});

}

});
