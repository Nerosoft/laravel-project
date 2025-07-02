let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false }
];
function validateBranche(brance_rays_name, brance_rays_phone, brance_rays_country, brance_rays_governments, brance_rays_city, brance_rays_street, brance_rays_building, brance_rays_address, brance_rays_follow){
    let state = true;
    if(brance_rays_name.val() === "" || brance_rays_name.val().length < 3){
        (new bootstrap.Toast($(brance_rays_name.val() === '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        brance_rays_name.addClass('error-message');
        state=false;
    }else
        brance_rays_name.removeClass('error-message');
    if(brance_rays_phone.val() === "" || (!isPhone(brance_rays_phone.val()))){
        (new bootstrap.Toast($(brance_rays_phone.val() === '' ? '#myToast3' : '#myToast4'), { delay: 10000 })).show();
        brance_rays_phone.addClass('error-message');
        state=false;
    }else
        brance_rays_phone.removeClass('error-message');

    if(brance_rays_country.val() === "" || brance_rays_country.val().length < 3){
        (new bootstrap.Toast($(brance_rays_country.val() === '' ? '#myToast5' : '#myToast6'), { delay: 10000 })).show();
        brance_rays_country.addClass('error-message');
        state=false;
    }else
        brance_rays_country.removeClass('error-message');

    if(brance_rays_governments.val() === "" || brance_rays_governments.val().length < 3){
        (new bootstrap.Toast($(brance_rays_governments.val() === '' ? '#myToast7' : '#myToast8'), { delay: 10000 })).show();
        brance_rays_governments.addClass('error-message');
        state=false;
    }else
        brance_rays_governments.removeClass('error-message');

    if(brance_rays_city.val() === "" || brance_rays_city.val().length < 3){
        (new bootstrap.Toast($(brance_rays_city.val() === '' ? '#myToast9' : '#myToast10'), { delay: 10000 })).show();
        brance_rays_city.addClass('error-message');
        state=false;
    }else
        brance_rays_city.removeClass('error-message');

    if(brance_rays_street.val() === "" || brance_rays_street.val().length < 3){
        (new bootstrap.Toast($(brance_rays_street.val() === '' ? '#myToast11' : '#myToast12'), { delay: 10000 })).show();
        brance_rays_street.addClass('error-message');
        state=false;
    }else
        brance_rays_street.removeClass('error-message');

    if(brance_rays_building.val() === "" || brance_rays_building.val().length < 3){
        (new bootstrap.Toast($(brance_rays_building.val() === '' ? '#myToast13' : '#myToast14'), { delay: 10000 })).show();
        brance_rays_building.addClass('error-message');
        state=false;
    }else
        brance_rays_building.removeClass('error-message');

    if(brance_rays_address.val() === "" || brance_rays_address.val().length < 3){
        (new bootstrap.Toast($(brance_rays_address.val() === '' ? '#myToast15' : '#myToast16'), { delay: 10000 })).show();
        brance_rays_address.addClass('error-message');
        state=false;
    }else
        brance_rays_address.removeClass('error-message');

    if(brance_rays_follow.val() === null){
        (new bootstrap.Toast($('#myToast17'), { delay: 10000 })).show();
        brance_rays_follow.addClass('error-message');
        state=false;
    }else
        brance_rays_follow.removeClass('error-message');

    return state;
}
function displayEditForm(brance_rays_name, brance_rays_phone, brance_rays_country, brance_rays_governments, brance_rays_city, brance_rays_street, brance_rays_building, brance_rays_address, brance_rays_follow, id, nameTest, phoneTest, countryTest, governmentsTest, cityTest, streetTest, buildingTest, addressTest, followTest){
    //clear all error value
    brance_rays_name.removeClass('error-message');
    brance_rays_phone.removeClass('error-message');
    brance_rays_country.removeClass('error-message');
    brance_rays_governments.removeClass('error-message');
    brance_rays_city.removeClass('error-message');
    brance_rays_street.removeClass('error-message');
    brance_rays_building.removeClass('error-message');
    brance_rays_address.removeClass('error-message');
    //---------------------------------------------------------------------
    brance_rays_name.val(nameTest);
    brance_rays_phone.val(phoneTest);
    brance_rays_country.val(countryTest);
    brance_rays_governments.val(governmentsTest);
    brance_rays_city.val(cityTest);
    brance_rays_street.val(streetTest);
    brance_rays_building.val(buildingTest);
    brance_rays_address.val(addressTest);
    brance_rays_follow.each(function(idx, el){
        if($(this).html() === followTest)
            $(this).prop('selected', true);
    });
    openForm(id);
}
