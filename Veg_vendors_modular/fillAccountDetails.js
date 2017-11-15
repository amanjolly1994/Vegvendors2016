function fillAccountDetails() {
    var data = JSON.parse(JSON.parse(localStorage.getItem('user-details')));
    //console.log(data);
    if (data['status'] == 'ok') {
        fillSideDivOnClickAccount(4);
        $('#user-image').attr({
            src: data['pic'],
        });
        $('#account-icon').text(data['name'])
    }
    else {
        $('#password-login').addClass('wrong');
        $('#email-login').addClass('wrong');
    }
}
