function showOnHover() {
    $(".hover-actions").hover(function() {
        //alert("hi");
        $(this).css({
            "font-size": "28px",
            "position": "relative",
            "left": "20px",
        });
        //$('.hoverItems').css("visibility","visible");
        //show_hover_div_with_id("vg")
        show_hover_div_with_id($(this).parent().parent().parent().attr("id"))
      console.log($(this).parent().parent().parent().prop("id"));
    //   hoverItemsInjector(this.pare)
    }, function() {
        $(this).css({
            "font-size": "17px",
            "position": "relative",
            "left": "0px",
        });
        //hide_hover_div_with_id("vg")
        //hide_hover_div_with_id($(this).parent().parent().parent().attr("id"))
        $('.hoverItems').css("visibility","hidden");
    });



}


function stayOnHover() {
    $(".hoverItems").hover(function() {
        //console.log($(this).attr("id"));
        show_hover_div_with_id($(this).attr("id"));
        //$('.hoverItems').css("visibility","visible");
    }, function() {
        //console.log($(this).attr("id"));
        hide_hover_div_with_id($(this).attr("id"));
    });
}
