let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];
function validateKnows(name){
    if(name.val() === ''){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        name.addClass('error-message');
        return false;
    }
    if(name.val().length < 3){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        name.addClass('error-message');
        return false;
    }
    else
        return true;
}
function displayEditForm(name, id, nameKnow){
    //clear all error
    name.removeClass('error-message');
    //-----------------------------------
    name.val(nameKnow);
    openForm(id);
}