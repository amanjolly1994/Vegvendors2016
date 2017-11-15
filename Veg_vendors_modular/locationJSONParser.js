// function locationJSONParser(locationSubList) {
//     for (var i = 0; i < locationSubList.length; i++) {
//         var place = locationSubList[i].place;
//         var code = locationSubList[i].code;
//         fillSubLocation(place, code);
//     }
// }

//var parsedLocations = {};
function areaParser() {
    var areas = locationJSON['Area'];
    for (var i = 0; i < areas.length; i++) {
        var areaName = areas[i]['AreaName'];
        var areaCode = areas[i]['AreaCode'];
        fillArea(areaName,areaCode);
    }
}
//
// function placeCodeParser(areaCode) {
//     //parsedLocations[areaCode] = [];
//     //var subs;
//     var places = locationJSON['location']['Places'];
//     for (var i = 0; i < places.length; i++) {
//         var place = places[i];
//         if (place['AreaCode'] == areaCode) {
//             //console.log("hi");
//             //console.log(place['PlaceCode']);
//             subs = subAreaParser(place['PlaceCode']);
//         }
//         //parsedLocations[areaCode].push.apply(parsedLocations[areaCode],subs);
//     }
//     //console.log(parsedLocations);
// }
//
// function subAreaParser(placeCode) {
//     var subAreas = locationJSON['location']['SubAreas'];
//     //var sub = [];
//     for (var i = 0; i < subAreas.length; i++) {
//         if(subAreas[i]['PlaceCode'] == placeCode){
//             //var obj = {};
//             //obj[subAreas[i]['Subareas']] = placeCode;
//             var placeCode = subAreas[i]['PlaceCode'];
//             var subAreaName = subAreas[i]['Subareas'];
//             var subAreaCode = subAreas[i]['subAreaCode'];
//             fillSubLocation(placeCode,subAreaCode,subAreaName);
//             //sub.push(obj);
//         }
//
//     }
//     //return sub;
//
// }


function parseLocation(searchAreaCode) {
        var areas = locationJSON['Area']             //variable in which json object is recieved
        for (var i = 0; i < areas.length; i++) {
            areaCode = areas[i]['AreaCode'];
            areaName = areas[i]['AreaName'];
            //console.log(areaName);
            if (areaCode == searchAreaCode) {
                var places = areas[i]['places'];
                for (var j = 0; j < places.length; j++) {
                    placeCode = places[j]['PlaceCode'];
                    subAreas = places[j]['SubAreas'];
                    //console.log(placeCode);
                    for (var k = 0; k < subAreas.length; k++) {
                        subAreaCode = subAreas[k]['SubareaCode'];
                        subAreaName = subAreas[k]['Subareas']
                        //console.log(subAreaCode);
                        //console.log(subAreaName);
                        fillSubLocation(placeCode,subAreaCode,subAreaName);
                    }
                }
            }
        }
     }
