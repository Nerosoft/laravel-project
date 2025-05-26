function validateFormLoginAdmin(){
    let isValid = true;
    if ($('#email').val() === "" || (!IsEmail($('#email').val()))){
        (new bootstrap.Toast($($('#email').val() !== '' ? '#myToast2' : '#myToast1'), { delay: 10000 })).show();
        $('#email').addClass('error-message');
        isValid = false;
    }else
        $('#email').removeClass('error-message');

    if ($('#password').val() === "" || $('#password').val().length < 8){
        (new bootstrap.Toast($($('#password').val() !== '' ? '#myToast4' : '#myToast3'), { delay: 10000 })).show();
        $('#password').addClass('error-message');
        isValid = false;
    }else
        $('#password').removeClass('error-message');
    return isValid;
}