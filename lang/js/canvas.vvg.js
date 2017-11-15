//JS for canvas display

//checkout page canvas
$(document).ready(function() {

  var newPhoneVar = "11";

  $(".checkout-change-address").click(function(event){
    event.preventDefault();

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
          $(".change-address-label").html(address);
          setTimeout(function(){ $(".canvas-box-holder").fadeOut(); }, 1200);
        }
        else {
          console.log("Error Occured While saving address.");
        }
      }

    });

  }

  $(".checkout-change-phone-button").click(function(event) {

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
      sendPhoneOtp(newPhone);
      return false;
    }
    else {
      $(".canvas-work-holder").append('<p class="canvas-warning-text">Please enter a valid 10 digit phone number.</p>');
    }

  });

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
          setCookie("new_phone",phone,0.5);
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
     }, 2000);
  }

  $(".rephone-enter").click(function(event) {
    event.preventDefault();
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
