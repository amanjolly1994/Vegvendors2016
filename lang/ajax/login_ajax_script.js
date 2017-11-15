//Log in via AJAX

$(document).ready(function()
{
$("#login").on("submit", "#loginForm", function(){
		ajaxLogin();
		return false;
});

function ajaxLogin()
{
	var ceta = $("#loginForm").serialize();

	$.ajax({

		type : 'POST',
		url  : '/lang/phpFiles/login_process.php',
		data : ceta,
		beforeSend: function()
		{
			messageBox("Logging you in. Please wait.","rgba(52, 73, 94,0.7)");
		},
		success :  function(response)
		   {
				if(response=="ok"){
					setTimeout(messageBox("Successful. Redirecting.", "rgba(46, 204, 113,1.0)"), 2000);
					location.reload();
				}
				else{
					messageBox("Wrong Email or Password. Please Try", "rgba(192, 57, 43,1.0)");
				}
		  }
	});

}

});
