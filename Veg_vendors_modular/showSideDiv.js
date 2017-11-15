/*function showSideDiv() {
    //animates side divs
    //console.log('inside showSideDiv');
    var element = $('#sideDiv');
    var width = element.css("width")
    //console.log('-'+width);
    element.css('right',('-'+width))
    element.css('visibility','visible')
    element.animate({
        right: 0},
        "fast");
}*/


function showSideDiv() {
    //animates side divs
    //console.log('inside showSideDiv');
    var element = $('#sideDiv');
    var width = element.css("width");
    //console.log('-'+width);
    element.css('right',('-'+width));
    element.css('visibility','visible');
    //console.log(element.css('visibility'));
    element.animate({
        right: 0},
        "fast");
    //console.log(element.css('right'));
}

function hideSideDiv() {
    //console.log("i");
    var element = $('#sideDiv');
    if (!(element.css("visibility") == 'hidden')) {
        var width = element.css("width")
        //console.log("width= "+width);

        var rightM = parseInt("-"+width);
        //console.log(rightM);


        /*for (var i = 0; i > rightM;  i = i - 0.5) {
            console.log(i);
            //alert("hi");

            element.css("right",(i + "px"));
        }*/

        element.animate({right: rightM},"fast")

        //console.log("right= "+element.css("right"));

        element.css('visibility','hidden');
        element.css('right','0px');
        $('body').css({opacity:1});
    }

}
