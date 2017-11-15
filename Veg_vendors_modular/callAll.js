function initialize() {
    //localStorage.clear();
    getLocationJSON();
    selectLocation();
    moduleAddToCart();
    cartAddToCart();
    moduleSubtractFromCart();
    cartSubtractFromCart();
    accountBasketEtcEventHandlers();
    categoryClick();
    showOnHover();
    stayOnHover();
    addFinally();



    clearCart();

    //JSONparserFromSabziListCumCombiner();
    //mainJSONVendorParser();
    loadFromStorage();
    loginUser();
    SUSI();
    registerUser();
    injectModal();
    socialLogin();

}
