function SUSI() {
    $('#login-button-account,#login-from-register').click(function(event) {
        //console.log("hi");
        fillSideDivOnClickAccount(3);
    });

    $('#logout-button').click(function(event) {
        localStorage.removeItem('user-details');
        fillSideDivOnClickAccount(1);
        $('#account-icon').text('ACCOUNT')

    });

    $('#signUp,#createNew').click(function(event) {
        fillSideDivOnClickAccount(5);
    });

    $('#dashboard-button').click(function(event) {
        window.location.replace('http://www.vegvendors.in/dashboard.php');
        //window.location.href = "http://www.google.com";
    });
}
