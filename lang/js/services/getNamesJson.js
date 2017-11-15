var vegnmList ;
function getNamesJson() {
    // var timestamp = localStorage.getItem('vegnmTS');
    $.ajax({
      url: 'http://www.vegvendors.in/android/vegnmlist.php',
      type: 'POST'
    })
    .done(function(data) {
      console.log("success");
      //console.log(data);
      vegnmList = data;
      //console.log(vegnmList);
      vegnmListParser();
      getMainJson();
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

}
