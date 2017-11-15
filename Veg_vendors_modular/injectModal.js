function injectModal() {
    $('.view-profile').click(function(event) {
        var obj = JSON.parse(localStorage.getItem("vendorList"));
        console.log(obj);
        var venTemp = $(this).parents('.vendor-temp');
        var vid = parseInt(venTemp.attr('id').match(/(\d+)$/)[0], 10);
        var name = venTemp.find('#vendor-name' + vid).text();
        var img = venTemp.find('#vendor-img' + vid).attr('src');
        var categories = venTemp.find('#vendor-categories' + vid).text();
        var area = JSON.parse(localStorage.getItem('location'))[1];
        var subarea = JSON.parse(localStorage.getItem('location'))[0];
        $('#vendor-profile').find('#vendor-name-modal').text(name);
        $('#vendor-profile').find('#vendor-image-modal').attr('src',img);
        $('#vendor-profile').find('#vid-modal').text(vid);

        if (obj[vid]['available'] == 1) {
            $('#vendor-profile').find('#modal-available').text('Available').addClass('btn-success');
        }
        else {
            $('#vendor-profile').find('#modal-available').text('Not Available').addClass('btn-danger');
        }
        $('#vendor-profile').find('#varea-modal').text(area);
        $('#vendor-profile').find('#vsubarea-modal').text(subarea);
        $('#vendor-profile').find('#vtimings-modal').text("9am - 7pm");

    });
}
