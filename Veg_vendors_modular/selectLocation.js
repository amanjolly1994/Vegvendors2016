function selectLocation() {
    $("#area").change(function () {
        // GET JSON - POST AREA
        parseLocation($('#area').val().split('-')[1]);
    });

    $("#sub-area").change(function() {
        localStorage.removeItem('cart');
        var location = [];
        var subArea = $('#sub-area').val().split('-')[1];    // 0- placeCode , 1- subAreaName , 2- subAreaCode
        var area = $('#area').val().split('-')[0];           // 0- areaName 1-areaCode
        var placeCode = $('#sub-area').val().split('-')[0];
        location.push(subArea);
        location.push(area);
        location.push(placeCode);
        $("#deliveryAt").text(subArea + ", " + area);
        hideSideDiv();
        localStorage.setItem("location",JSON.stringify(location));
        //console.log(location);
        setCookie("location",JSON.stringify(location),1)
        //document.cookie = "location=" + JSON.stringify(location)
        //console.log(location);
        postPlaceCode(placeCode);
        //window.location.reload();

    });
}

function postPlaceCode(placeCode) {
    $.ajax({
        url: 'http://www.vegvendors.in/android1/mainJson.php',
        type: 'POST',
        dataType: 'JSON',
        data: {code: placeCode}
    })
    .done(function(value) {
        console.log("success");
        setMainJSON(value);
        JSONparserFromSabziListCumCombiner();


    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        loadStamps();
    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
