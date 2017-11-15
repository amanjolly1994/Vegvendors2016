<!DOCTYPE html>
<html lang="en">
<head>
  <!-- JS script -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
	<meta name="google-signin-client_id" content="966617801310-2cot46e2pdv28kjsgv2d4rsmpg18791c.apps.googleusercontent.com">

  <link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />

  <!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

  <script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>
  <script type="text/javascript" src="/lang/js/social-login.js" async defer></script>

  <style>
    .singleRegisterPage{
      background: none !important;
      width: 360px;
      height: auto;
    }

    .iframeLogin{
      overflow: hidden;
    }

    #iframeLogin{
      display: block;
    }

    #iframeSignup{
      display: none;
    }

    .icon-social-facebook::before {
      content: "\e917";
    }

    .icon-mail-envelope-closed::before {
      content: "\e913";
    }

  </style>

  <script type="text/javascript">
  $(document).ready(function(){

    $(".changeiframeSignup").click(function(event){
      event.preventDefault();
      $("#iframeLogin").hide();
      $("#iframeSignup").fadeIn();
    });

    $(".changeiframeLogin").click(function(event){
      event.preventDefault();
      $("#iframeSignup").hide();
      $("#iframeLogin").fadeIn();
    });

    $(".iframeLogin, .tunnel-row-1").on("submit", "#loginForm", function(event){
      event.preventDefault();
      ajaxFrameLogin();
      return false;
    });

    function ajaxFrameLogin()
    {
      var qeta = $("#loginForm").serialize();

      $.ajax({

        type : 'POST',
        url  : '/lang/phpFiles/login_process.php',
        data : qeta,

        beforeSend: function()
    		{
          console.log("In beforeSend data = "+qeta);
    			messageBox("Logging in. Please wait.","rgba(52, 73, 94,0.7)");
    		},
    		success :  function(response)
  		  {
          alert("inside Success");
  				if(response=="ok"){
            alert("Success");
  					setTimeout(messageBox("Successful. Redirecting.", "rgba(46, 204, 113,1.0)"), 2000);
  					location.reload();
  				}
  				else{
            alert("error");
  					messageBox("Wrong Email or Password. Please Try", "rgba(192, 57, 43,1.0)");
  				}
  		  }

      });
    }

  });

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
  </script>

</head>

<body class="singleRegisterPage">

  <div class="iframeLogin">

    <div id="iframeLogin">
    <p class="sideLines"><span>Sign In Via</span></p>

    <div class="socialLoginBox">
      <div class="facebookLoginButton" onclick="loginFB()">
        <span class="icon-social-facebook font20"></span>
        <span class="mls">facebook</span>
      </div>

      <div id="gSignIn" class="googleLoginButton"></div>

      <div class="clear"></div>
    </div>

    <p class="sideLines leave10"><span>Or Use Email</span></p>

    <form class="loginForm" id="loginForm" method="post">

      <div class="input">

      <input type="email" name="user_email" placeholder="Email Address" required  style="text-transform: lowercase" />

      <span class="icon-mail-envelope-closed"></span>

      </div>

      <div class="input">

      <input type="password" name="user_password" placeholder="Password" required />

      <span class="icon-lock"></span>

      </div>
      <input type="submit" value="Login" />

      <p class="forgotPassword">forgot password?</p>

      <p class="signUpPage">Don't have an account? <a href="#" class="changeiframeSignup">Sign Up</a></p>

    </form>

  </div>

  <div id="iframeSignup">
    <p class="sideLines"><span>Sign Up Via</span></p>

    <div class="socialLoginBox">
      <div class="facebookLoginButton" onclick="loginFB()">
        <span class="icon-social-facebook font20"></span>
        <span class="mls">facebook</span>
      </div>

      <div class="g-signin2 googleLoginButton" data-width="150" data-height="35"></div>

      <div class="clear"></div>
    </div>

    <p class="sideLines leave10"><span>Or Use Email</span></p>

    <form class="loginForm" method="post" id="registrationForm" name="registrationForm">

      <div class="input">

      <input type="text" name="full_name" placeholder="Full Name" required />

      <span class="icon-account"></span>

      </div>

      <div class="input">

      <input type="email" name="user_email" placeholder="Email Address"  style="text-transform: lowercase" required />

      <span class="icon-mail-envelope-closed"></span>

      </div>

      <div class="input">

      <input type="password" name="user_password" placeholder="Password" required />

      <span class="icon-lock"></span>

      </div>
      <input type="submit" value="Get Started" />

      <p class="signUpPage">Already have an account? <a href="#" class="changeiframeLogin">Login</a></p>

    </form>
  </div>

  </div>

</body>
</html>
