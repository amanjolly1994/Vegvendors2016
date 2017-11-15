function hoverItemsInjector(categoryName,categoryID,names,sids) {
    //console.log(names);
    console.log(categoryID);
    var hoverItem = $("#dummy-hover-item").clone(true);
    id = "hover" + categoryName.replace(/\s/g,"");
    hoverItem.attr("id",id);
    hoverItem.find('#header').text(categoryName)
    //console.log(id);
    for (var i = 0; i < names.length; i++) {
        var hoverLI = $("#hover-list-item").clone(true);
        searchId = "veg" + sids[i];
        hoverLI.find('#vegname').text(names[i]);
        hoverLI.attr("id",searchId);
        hoverLI.find('#link').attr('href',('http://www.vegvendors.in/pcveg.php?cat='+ categoryID + '&sc=' + sids[i])).attr('id',('link' + sids[i]));
        //console.log(names[i]);
        //console.log(hoverLI.find('#vegname').text());

        hoverLI.appendTo(hoverItem.find("#hoverItemsList"));
    }

    //alert("hi");
    //console.log(hoverItem.find("#hoverItemsList"));
    //console.log(hoverItem);
    hoverItem.css("visibility:visible");
    hoverItem.appendTo('body')
}



/*function hoverItemsInjector(categoryName,names) {
    var hoverItem = $("#hoverItem").clone(true);
    var hoverList = $("#hoverListWrapper").clone(true);
    var hoverUL = $("#hoverItemsList").clone(true);
    var hoverHeader = $("#header").clone(true);
    var hoverLI = $("#hover-list-item").clone(true);
    var vegname = $("#vegname").clone(true);

    hoverItem.attr("id",categoryName);

    hoverHeader.text(categoryName);
    hoverHeader.appendTo(hoverList);

    //console.log(categoryName);
    for (var i = 0; i < names.length; i++) {
        //console.log(names[i]);
        vegname.text(names[i]);
        vegname.appendTo(hoverList);
    }
    hoverList.appendTo(hoverUL);
    hoverUL.appendTo(hoverItem);
    hoverItem.appendTo('body');
    //hoverItem.append('hi there')
    console.log(JSON.stringify(hoverItem));
}*/
