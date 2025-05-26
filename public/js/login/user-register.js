function validateFormRegisterAdmin(){
    let isValid = validateFormLoginAdmin();
    if ($('#password').val() !== $('#password_confirmation').val()){
        (new bootstrap.Toast('#myToast5', { delay: 10000 })).show();
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