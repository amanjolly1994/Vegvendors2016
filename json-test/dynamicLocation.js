var locationX;
function getJson()
{
  // getting json from server
  $.ajax({

    type : 'POST',
    url : '/android/mainAreaJson.php',

    beforeSend : function() {},
    success : function(value) {
      //locationX = value;
      areaParser(JSON.parse(value));
      selectLocation(JSON.parse(value));
    }
  });

}

function areaParser(locationX) {
    //console.log(locationX);
    var areas = locationX['Area'];
    //console.log(areas);
    for (var i = 0; i < areas.length; i++) {
        var areaName = areas[i]['AreaName'];
        var areaCode = areas[i]['AreaCode'];
        //console.log(areaName);
        //console.log(areaCode);
        //parseLocation(areaCode,locationX);
        fillArea(areaName,areaCode);
    }
}

function parseLocation(searchAreaCode,locationX) {
        var areas = locationX['Area'];             //variable in which json object is recieved
        for (var k = 0; k < areas.length; k++) {
            areaCode = areas[k]['AreaCode'];
            areaName = areas[k]['AreaName'];
            //console.log(areaName);
            if (areaCode == searchAreaCode) {
                var places = areas[k]['places'];
                for (var i = 0; i < places.length; i++) {
                    placeCode = places[i]['PlaceCode'];
                    subAreas = places[i]['SubAreas'];
                    //console.log(placeCode);
                    for (var j = 0; j < subAreas.length; j++) {
                        subAreaCode = subAreas[j]['SubareaCode'];
                        subAreaName = subAreas[j]['Subareas'];
                        //console.log("plcaecode: " + placeCode);
                        //console.log("subareacode: " + subAreaCode);
                        //console.log(subAreaName);
                        fillSubLocation(placeCode,subAreaCode,subAreaName);
                    }
                }
            }
        }
    }

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

function selectLocation(locationX) {
        $("#areaSelect").change(function () {
          var val = $('#areaSelect').val().split('-')[1];
          //console.log(val);
          //console.log(locationX);
            parseLocation(val,locationX);
        });

        $("#locationForm").submit(function () {
            var location = [];
            var subAreaName = $('#subAreaSelect').val().split('-')[1];
            var subAreaCode = $('#subAreaSelect').val().split('-')[2];
            var areaName = $('#areaSelect').val().split('-')[0];
            var areaCode =  $('#areaSelect').val().split('-')[1];
            var placeCode = $('#subAreaSelect').val().split('-')[0];
            location.push(areaCode);   // 0 - area code
            location.push(areaName);    // 1 area name
            location.push(placeCode);  // 2 placeCode
            location.push(subAreaCode); // 3 subarea code
            location.push(subAreaName);  // 4 sub area name


            console.log(location);
            console.log(placeCode);
            setCookie('location',JSON.stringify(location),365);
            //POST plcaecode

        });

}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}
