function accountBasketEtcEventHandlers() {
    //console.log('inside accountBasketEventHandlers');
    $("#basket-icon").click(function functionName() {  //basket icon event handler
        fillSideDivOnClickAccount(1);
        showSideDiv();
        $('body').css({opacity:0.8});
    });

    $("#account-icon").click(function functionName() {  //account-event handler
        fillSideDivOnClickAccount(1);
        showSideDiv();
        $('body').css({opacity:0.8});
    });

    $(document).click(function () {
        hideSideDiv();
        $('#quick-actions').fadeIn('fast');
        $('#search-item').fadeOut('fast');

    });
    $(".back-button").click(function () {
        hideSideDiv();

    });

    $("#sideDiv,#account-icon,#basket-icon,#location-click,#search-item,#search").on('click',function b(e) {
        // if (!$(e.target).hasClass('.google-login')) {
        // alert('Show dialog!');
        e.stopPropagation(); // This is the preferred method.
        return false;        // This should not be used unless you do not want

    // }
         // any click events registering inside the div
    });

    $("#location-click").click(function() {
        $('#quick-actions').fadeIn('fast');
        $('#search-item').fadeOut('fast');
        fillSideDivOnClickAccount(2);
        showSideDiv();
        $('body').css({opacity:0.8});
    });

    $('#search').click(function() {
        //console.log("hi");
        $('#quick-actions').fadeOut('fast');
        $('#search-item').fadeIn('fast');
    });

    $('#search-text').on('keyup', function (event) {
       // console.log(event.which);

       if((event.which >= 65 && event.which <= 90) || event.which == 8 || event.which == 46 ){

          searchItem($('#search-text').val());
        }
    });

    $('.google-login').click(function(event) {
        $('body')
    });


}
