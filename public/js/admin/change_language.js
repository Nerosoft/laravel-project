let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false }
];

function validName(name){
    if(name.val() === ''){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        name.addClass('error-message');
        return false;
    }else if(name.val().length < 3){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        name.addClass('error-message');
        return false;
    }else
        name.removeClass('error-message');
    return true;
}