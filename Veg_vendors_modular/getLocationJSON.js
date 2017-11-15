var locationJSON;
function getLocationJSON() {
    $.ajax({
        url: 'http://www.vegvendors.in/android/mainAreaJson.php',
        type: 'POST',
        dataType: 'JSON',
    })
    .done(function(value) {
        locationJSON = value;
        //console.log(value);
        sessionStorage.setItem('locationJSON',JSON.stringify(value));
        //console.log("hi");
        areaParser();
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        //console.log("complete");
    });

}
