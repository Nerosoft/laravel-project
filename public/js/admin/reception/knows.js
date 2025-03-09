let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];
function validateKnows(name){
    if(name.val() === '' || name.val().length < 3){
        (new bootstrap.Toast($(name.val() === '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
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