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
