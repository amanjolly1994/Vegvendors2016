function removeEveryItem(func) {
    $('.category-temp').remove();
    $('.item-temp').remove();
    $('.vendor-temp').remove();
    func();
}
