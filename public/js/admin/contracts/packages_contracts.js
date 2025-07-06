let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];
function validateContract(name, governorate, area){
    isValid = true;
    if(name.val() === ''){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        name.addClass('error-message');
        isValid = false;
    }else if(name.val().length < 3){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        name.addClass('error-message');
        isValid = false;
    }else
        name.removeClass('error-message');
    if(governorate.val() === ''){
        (new bootstrap.Toast('#myToast3', { delay: 10000 })).show();
        governorate.addClass('error-message');
        isValid = false;
    }else if(governorate.val().length < 3){
        (new bootstrap.Toast('#myToast4', { delay: 10000 })).show();
        governorate.addClass('error-message');
        isValid = false;
    }else
        governorate.removeClass('error-message');
    if(area.val() === ''){
        (new bootstrap.Toast('#myToast5', { delay: 10000 })).show();
        area.addClass('error-message');
        isValid = false;
    }else if(area.val().length < 3){
        (new bootstrap.Toast('#myToast6', { delay: 10000 })).show();
        area.addClass('error-message');
        isValid = false;
    }else
        area.removeClass('error-message');
    return isValid;
}
function displayEditForm(name, governorate, area, id, nameTest, governorateTest, areaTest){
    //clear all error
    name.removeClass('error-message');
    governorate.removeClass('error-message');
    area.removeClass('error-message');
    //----------------------------------
    name.val(nameTest);
    governorate.val(governorateTest);
    area.val(areaTest);
    openForm(id);
}