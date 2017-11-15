function show_hover_div_with_id(id) {

    if(!(id.search("hover") > -1)){
        //console.log("NO did  not  find hover adding to it!");
        id = "#hover" + id ;
        //console.log(id);
    }
    else {
        id = "#" + id;
    }

    //console.log("hi show this " + id);
    $(id).css({
        visibility: 'visible'
    });
}

function hide_hover_div_with_id(id) {
    if(!(id.search("hover") > -1)){
        //console.log("NO did  not  find hover adding to it!");
        id = "#hover" + id ;
        //console.log(id);
    }
    else {
        id = "#" + id;
    }
    //console.log("hide this "+id);
    $(id).css({
        visibility: 'hidden'
    });
}
