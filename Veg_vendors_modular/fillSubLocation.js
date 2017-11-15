function fillSubLocation(placeCode,subAreaCode,subAreaName) {
    //console.log("inside fillSubLocation");
    //console.log("ji");
    var element = $('#sub-area').find('#clone-option').clone(true);
    element.attr('value',(placeCode + '-' + subAreaName + '-' + subAreaCode));
    element.attr('id',('clone-option' + subAreaCode));
    element.text(subAreaName);
    //console.log(element);
    element.appendTo('#sub-area');
}
