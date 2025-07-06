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
    if(brance_rays_name.val() === ""){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        brance_rays_name.addClass('error-message');
        state=false;
    }else if(brance_rays_name.val().length < 3){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        brance_rays_name.addClass('error-message');
        state=false;
    }else
        brance_rays_name.removeClass('error-message');
    if(brance_rays_phone.val() === ""){
        (new bootstrap.Toast('#myToast3', { delay: 10000 })).show();
        brance_rays_phone.addClass('error-message');
        state=false;
    }else if((!isPhone(brance_rays_phone.val()))){
        (new bootstrap.Toast('#myToast4', { delay: 10000 })).show();
        brance_rays_phone.addClass('error-message');
        state=false;
    }else
        brance_rays_phone.removeClass('error-message');

    if(brance_rays_country.val() === ""){
        (new bootstrap.Toast('#myToast5', { delay: 10000 })).show();
        brance_rays_country.addClass('error-message');
        state=false;
    }else if(brance_rays_country.val().length < 3){
        (new bootstrap.Toast('#myToast6', { delay: 10000 })).show();
        brance_rays_country.addClass('error-message');
        state=false;
    }else
        brance_rays_country.removeClass('error-message');

    if(brance_rays_governments.val() === ""){
        (new bootstrap.Toast('#myToast7', { delay: 10000 })).show();
        brance_rays_governments.addClass('error-message');
        state=false;
    }else if(brance_rays_governments.val().length < 3){
        (new bootstrap.Toast('#myToast8', { delay: 10000 })).show();
        brance_rays_governments.addClass('error-message');
        state=false;
    }else
        brance_rays_governments.removeClass('error-message');

    if(brance_rays_city.val() === ""){
        (new bootstrap.Toast('#myToast9', { delay: 10000 })).show();
        brance_rays_city.addClass('error-message');
        state=false;
    }else if(brance_rays_city.val().length < 3){
        (new bootstrap.Toast('#myToast10', { delay: 10000 })).show();
        brance_rays_city.addClass('error-message');
        state=false;
    }else
        brance_rays_city.removeClass('error-message');

    if(brance_rays_street.val() === ""){
        (new bootstrap.Toast('#myToast11', { delay: 10000 })).show();
        brance_rays_street.addClass('error-message');
        state=false;
    }else if(brance_rays_street.val().length < 3){
        (new bootstrap.Toast('#myToast12', { delay: 10000 })).show();
        brance_rays_street.addClass('error-message');
        state=false;
    }else
        brance_rays_street.removeClass('error-message');

    if(brance_rays_building.val() === ""){
        (new bootstrap.Toast('#myToast13', { delay: 10000 })).show();
        brance_rays_building.addClass('error-message');
        state=false;
    }else if(brance_rays_building.val().length < 3){
        (new bootstrap.Toast('#myToast14', { delay: 10000 })).show();
        brance_rays_building.addClass('error-message');
        state=false;
    }else
        brance_rays_building.removeClass('error-message');

    if(brance_rays_address.val() === ""){
        (new bootstrap.Toast('#myToast15', { delay: 10000 })).show();
        brance_rays_address.addClass('error-message');
        state=false;
    }else if(brance_rays_address.val().length < 3){
        (new bootstrap.Toast('#myToast16', { delay: 10000 })).show();
        brance_rays_address.addClass('error-message');
        state=false;
    }else
        brance_rays_address.removeClass('error-message');

    if(brance_rays_follow.val() === null){
        (new bootstrap.Toast('#myToast17', { delay: 10000 })).show();
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
