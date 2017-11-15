function vegnmListParser() {
    //testTS();
    //console.log(vegnmList);
    var level1 = JSON.parse(vegnmList)['vegnmlist'];
    //console.log(level1);
    var obj = {};
    for (var i = 0; i < level1.length; i++) {
        try {
          level2 = level1[i]
          //console.log(level2);
          //console.log(sid + " : " + level2['sabzi_id']);
                  var names = [];
                  //further levels have been skipped as it has only constant number of key value pairs for all vegetables and can be extracted manually.
                  var name = level2['sabziNames'][0]['name'];
                  names.push(name);
                  //console.log(name);
                  var hinglish = level2['sabziNames'][0]['hinglish'];
                  names.push(hinglish);
                  //console.log(hinglish);
                  var hindi_name = level2['sabziNames'][0]['hindi_name'].split(" ");
                  names.push(hindi_name);
                  //console.log(hindi_name);
                  obj[level2['sabzi_id']] = names;
        } catch (e) {

        }
        }
        //console.log(obj);
        return obj;

        //console.log(obj);
    }
