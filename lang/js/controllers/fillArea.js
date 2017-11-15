function fillArea(areaName,areaCode) {
        var element = $("#areaSelect").find('#clone-area').clone(true);   //set id of option tag to be "clone-area"
        element.text(areaName);
        element.attr({
            value: areaName + '-' + areaCode,
            id:("clone-area" + areaCode)
        });
        element.appendTo('#areaSelect');
}

function fillSubLocation(placeCode,subAreaCode,subAreaName) {
        //console.log("inside fillSubLocation");
        var element = $('#subAreaSelect').find('#clone-sub-area').clone(true);  //set id of option inside sub area select to be "clone-sub-area"
        element.attr('value',placeCode + '-' + subAreaName + '-' + subAreaCode);
        element.attr('id',('clone-option' + subAreaCode))
        element.text(subAreaName);
        //console.log(element);
        element.appendTo('#subAreaSelect');
    }
