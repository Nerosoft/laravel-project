function validateFormLoginAdmin(){
    let isValid = true;
    if ($('#email').val() === ""){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        $('#email').addClass('error-message');
        isValid = false;
    }else if((!IsEmail($('#email').val()))){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        $('#email').addClass('error-message');
        isValid = false;
    }else
        $('#email').removeClass('error-message');
    if ($('#password').val() === ""){
        (new bootstrap.Toast('#myToast4', { delay: 10000 })).show();
        $('#password').addClass('error-message');
        isValid = false;
    }else if($('#password').val().length < 8){
        (new bootstrap.Toast('#myToast3', { delay: 10000 })).show();
        $('#password').addClass('error-message');
        isValid = false;
    }else
        $('#password').removeClass('error-message');
    return isValid;
}