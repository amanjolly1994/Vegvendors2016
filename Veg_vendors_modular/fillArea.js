function fillArea(areaName,areaCode) {
    var element = $("#area").find('#clone-area').clone(true);
    element.text(areaName);
    element.attr("value",areaName + '-' + areaCode);
    element.attr('id',("clone-area" + areaCode));
    element.appendTo('#area');
}
