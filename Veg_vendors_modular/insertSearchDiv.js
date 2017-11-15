$.fn.scrollView = function () {          // a specific jquery function
    return this.each(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top
        }, 700);
    });
}

function insertSearchDiv(categoryID,sid,name,price,incrementRate,url) {   //function insertSearchDiv(productID,categoryID,sid,name,price,incrementRate,url)

    var element = $('#search-result').clone(true);
    //console.log(name);
    element.attr({
        id : 'search-result' + sid,
        categoryID : categoryID,
        sid: sid,
        itemName: name,
        price : price,
        incrementRate : incrementRate
    });
    element.find('#image-search').attr({
        src: url,
        id: 'image-search' + sid
    });

    // element.find('#link-search-img').attr({
    //     href: '#item' + sid,
    //     id: 'link-search-img' + sid
    // });
    // element.find('#link-search-name').attr({
    //     href: '#item' + sid,
    //     id: 'link-search-name' + sid
    // });
    element.find('#name-search').attr('id',('name-search' + sid)).text(name);
    element.removeClass('dummy');
    element.removeClass('inline-x');

    if ($('#search-result' + sid).length == 0) {
        element.appendTo('#search-items-here');
    }
    else {
        element.replaceWith($('#search-result' + sid));
    }
    attachLinkToSamePage(sid);
    // try {
    //     element.replaceWith(('#name-search' + sid));
    // } catch (e) {
    //     element.appendTo('#search-item');
    // } finally {
    //
    // }
}


function attachLinkToSamePage(sid) {
    $("#image-search" + sid ).click(function(event) {
        $('#item' +sid).scrollView();
    });
    $('#name-search' + sid).click(function(event) {
        $('#item' +sid).scrollView();
    });
    $('#search-result' + sid).click(function(event) {
        $('#item' +sid).scrollView();
        $('#quick-actions').fadeIn('fast');
        $('#search-item').fadeOut('fast');
    });
}
