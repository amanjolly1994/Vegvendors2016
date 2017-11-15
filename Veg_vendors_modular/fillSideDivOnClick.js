function fillSideDivOnClickAccount(flag) {

    if (flag == 5) {
        if (!($('#register').parent().attr('id') == 'sideDiv')) {
            //console.log("hi");
            var register = $('#register').clone(true);
            register.removeClass('dummy');
            console.log(register);
            register.insertBefore('#insert-account-here');
            if (register.siblings('#account') != null ) {
                register.siblings('#account').remove();
            }
            if (register.siblings('#location') != null) {
                register.siblings('#location').remove();
            }
            if (register.siblings('#login') != null) {
                register.siblings('#login').remove();
            }
            if (register.siblings('#login-account') != null) {
                register.siblings('#login-account').remove();
            }
        }
    }


    if (flag == 4) {           //logged in div

        if (!($('#login-account').parent().attr('id') == 'sideDiv')) {
            //console.log("hi");
            var loginAcc = $('#login-account').clone(true);
            loginAcc.removeClass('dummy');
            console.log(loginAcc);
            loginAcc.insertBefore('#insert-account-here');
            if (loginAcc.siblings('#account') != null ) {
                loginAcc.siblings('#account').remove();
            }
            if (loginAcc.siblings('#location') != null) {
                loginAcc.siblings('#location').remove();
            }
            if (loginAcc.siblings('#login') != null) {
                loginAcc.siblings('#login').remove();
            }
            if (loginAcc.siblings('#register') != null) {
                loginAcc.siblings('#register').remove();
            }
        }
    }

    if (flag == 3) {         //inserts login div
        if (!($('#login').parent().attr('id') == 'sideDiv')) {
            var login = $('#login').clone(true);
            login.removeClass('dummy');
            console.log(login);
            login.insertBefore('#insert-account-here');
            if (login.siblings('#account') != null ) {
                login.siblings('#account').remove();
            }
            if (login.siblings('#location') != null) {
                login.siblings('#location').remove();
            }
            if (login.siblings('#login-account') != null) {
                login.siblings('#login-account').remove();
            }
            if (login.siblings('#register') != null) {
                login.siblings('#register').remove();
            }

        }
    }

    if (flag == 2) {  //shows location
        if (!($("#location").parent().attr("id") == "sideDiv")) {
            var location = $("#location").clone(true);
            location.removeClass('dummy');
            //account.children('selector')
            //console.log(account);

            location.insertBefore('#insert-account-here');
            if (location.siblings('#account') != null) {
                //console.log(location);
                //console.log(location.siblings('#account'));
                location.siblings('#account').remove();
            }
            if (location.siblings('#login') != null) {
                location.siblings('#login').remove();
            }
            if (location.siblings('#login-account') != null) {
                location.siblings('#login-account').remove();
            }
            if (location.siblings('#register') != null) {
                location.siblings('#register').remove();
            }
        }

    }

    if (flag == 1) {           //shows account

        //console.log('inside fillSideDivOnClickAccount');
        if (localStorage.getItem('user-details') != null) {
            fillAccountDetails();
        }
        else {
            if (!($("#account").parent().attr("id") == "sideDiv")) {
                var account = $("#account").clone(true);
                account.removeClass('dummy');
                //account.children('selector')
                //console.log(account);

                account.insertBefore('#insert-account-here');
                if (account.siblings('#location') != null) {
                    //console.log(account);
                    //console.log(account.siblings('#location'));
                    account.siblings('#location').remove();
                }
                if (account.siblings('#login') != null) {
                    account.siblings('#login').remove();
                }
                if (account.siblings('#login-account') != null) {
                    account.siblings('#login-account').remove();
                }
                if (account.siblings('#register') != null) {
                    account.siblings('#register').remove();
                }

            }
        }
    }
    fillCart();


}

function fillCart() {
    $('#basket').empty();
            try {
                cart = JSON.parse(localStorage.getItem('cart'));
                for (var key in cart) {
                    if (cart.hasOwnProperty(key)) {
                        var cartItem = $("#cart-item").clone(true);
                        temp = cart[key];
                        cartItem.attr({
                            "id": ("cart-item"+key),
                            "name": temp[0],
                            "totalWeight": temp[1],
                            "price": temp[2],
                            "value": temp[3],
                            "sid": key,
                            "totalprice":temp[4]
                        });
                        // var childCartItem = cartItem.find('span');
                        // console.log(childCartItem);
                        //
                        // childCartItem[0].text(temp[0]);
                        // childCartItem[2].text(temp[1] + "KGs in the cart");
                        // childCartItem[5].text(temp[4]);
                        console.log();
                        cartItem.find('#name-cart-item').attr({"id":("name-cart-item"+key)}).text(temp[0]);
                        cartItem.find('#weight-cart-item').attr({"id":("weight-cart-item"+key)}).text(temp[1]);
                        cartItem.find('#cart-item-price').attr({"id":("cart-item-price"+key)}).text(temp[4]);
                        cartItem.find('#subtract-cart-item').attr('id',('subtract-cart-item' + key));
                        cartItem.find('#add-cart-item').attr('id',('add-cart-item' + key));

                        cartItem.removeClass('dummy');


                        cartItem.appendTo('#basket');

                    }
                }
            } catch (e) {
                //console.log("does not have cart property");
            }
}
