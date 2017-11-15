function registerUser() {
    $('#submitRegisterForm').click(function(event) {
        var name = $('#full-name').val();
        var email = $('#email-register').val();
        var password = $('#password-register').val();
        $.ajax({
            url: 'http://www.vegvendors.in/android1/register.php',
            type: 'POST',
            data: {
                full_name:name,
                user_email:email,
                user_password:password
            }
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

    });
}
