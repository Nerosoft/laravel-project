function validateForm(){
    let isValid = true;
    if ($('#email').val() === "" || (!IsEmail($('#email').val()))){
        (new bootstrap.Toast($($('#email').val() !== '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        $('#email').addClass('error-message');
        isValid = false;
    }else
        $('#email').removeClass('error-message');

    if ($('#password').val() === "" || $('#password').val().length < 8 || $('#password').val() !== $('#password_confirmation').val()){
        (new bootstrap.Toast($('#password').val() === "" ? '#myToast3' : $('#password').val().length < 8 ? '#myToast4':'#myToast5', { delay: 10000 })).show();
        $('#password').addClass('error-message');
        isValid = false;
    }else
        $('#password').removeClass('error-message');

    if ($('#password_confirmation').val() === "" || $('#password_confirmation').val().length < 8 || $('#password').val() !== $('#password_confirmation').val()){
        (new bootstrap.Toast($('#password_confirmation').val() === "" ? '#myToast6' : $('#password_confirmation').val().length < 8 ? '#myToast7':'#myToast5', { delay: 10000 })).show();
        $('#password_confirmation').addClass('error-message');
        isValid = false;
    }else
        $('#password_confirmation').removeClass('error-message');

    if ($('#codePassword').val() === "" || $('#codePassword').val().length < 8){
        (new bootstrap.Toast($('#codePassword').val() === "" ? '#myToast8' : '#myToast9', { delay: 10000 })).show();
        $('#codePassword').addClass('error-message');
        isValid = false;
    }else
        $('#codePassword').removeClass('error-message');
        
    return isValid;
}