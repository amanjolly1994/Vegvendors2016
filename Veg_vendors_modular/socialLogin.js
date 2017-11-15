function socialLogin() {

    $('.facebook-login').click(function(event) {
        FB.login(function (response) {
            // if (response.authResponse) {
            //  console.log('Welcome!  Fetching your information.... ');
            //  console.log(response);
            //  FB.api('/me', function(response) {
            //    console.log('Good to see you, ' + response.name + '.');
            //  });
            // } else {
            //  console.log('User cancelled login or did not fully authorize.');
            // }
            if (response.status === 'connected') {
                console.log(response);
                // Logged into your app and Facebook.
              } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                console.log("not auth");
                console.log(response);
              } else {
                  console.log("not logged in");
                  console.log(response);
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
            }
        }, {scope: 'public_profile,email'});
    });

    $('.google-login').click(function(event) {
        console.log("hi");
        onSignIn();
    });
}
