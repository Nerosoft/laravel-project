let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false }
];

function validName(name){
    if(name.val() === '' || name.val().length < 3){
        (new bootstrap.Toast($(name.val() === '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        name.addClass('error-message');
        return false;
    }else
        name.removeClass('error-message');
    return true;
}