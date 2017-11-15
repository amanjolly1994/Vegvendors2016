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
      localStorage.setItem("locationJSON",value);
      areaParser(JSON.parse(value));
      selectLocation(JSON.parse(value));
    }
  });

}
