function validateForm(){
    let isValid = true;
    if ($('#email').val() === "" || (!IsEmail($('#email').val()))){
        (new bootstrap.Toast($($('#email').val() !== '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        $('#email').addClass('error-message');
        isValid = false;
    }else
        $('#email').removeClass('error-message');

    if ($('#password').val() === "" || $('#password').val().length < 8){
        (new bootstrap.Toast($($('#password').val() !== '' ? '#myToast3' : '#myToast4'), { delay: 10000 })).show();
        $('#password').addClass('error-message');
        isValid = false;
    }else
        $('#password').removeClass('error-message');
    return isValid;
}