function loginUser() {
    $('#submitLoginForm').click(function(event) {
        var email = $('#email-login').val();
        var password = $('#password-login').val();
        $.ajax({
            url: 'http://www.vegvendors.in/android1/login.php',
            type: 'POST',
            dataType: 'text',
            data: {
                flag: '1',
                id : email,
                password : password
                }
        })
        .done(function(data) {
            console.log("success-login");
            localStorage.setItem('user-details',JSON.stringify(data));
            fillAccountDetails();
        })
        .fail(function() {
            console.log("error-login");
        })
        .always(function(data) {
            console.log("complete-login");
            //console.log(data);
        });

    });
}
