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
