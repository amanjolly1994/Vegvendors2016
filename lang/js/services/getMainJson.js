var mainJSON ;
function getMainJson() {
  var placeCode = JSON.parse(getCookie('location'))[2];
  //console.log(placeCode);
  $.ajax({
    url: 'http://www.vegvendors.in/android/mainJson.php',
    type: 'POST',
    dataType: 'json',
    data: {code: placeCode}
  })
  .done(function(data) {
    console.log("success");
    mainJSON = data;
    mainJSONParser();
    //console.log(data);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}
