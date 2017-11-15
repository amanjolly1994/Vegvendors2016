function categoryInjector(categoryName) {
    //console.log("yo in category injectoer");
    var categoryItem = $("#item-wrapper").clone(true);
    //console.log(categoryItem);
    categoryItem.attr("id",categoryName.replace(/\s/g,''));

    categoryItem.removeClass('dummy')

    //console.log(categoryName);
    //var categorySpan = categoryItem.find('#category-name').text(categoryName);
    categoryItem.find('#category-name').text(categoryName);
    //console.log(categorySpan.text());

    if ($('#category' + categoryName.replace(/\s/g,"")).length == 0) {
    categoryItem.appendTo('#category-main-list');
    }
    //console.log(categoryItem);
    //console.log(JSON.stringify(categoryItem.children('#category-name')));
}
/**
function listItemsInjector(category,name) {
    var listItemsDiv = $("dummy").clone(true);
    lis
}**/
