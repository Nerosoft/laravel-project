function validateFormRegisterAdmin(){
    let isValid = validateFormLoginAdmin();
    if ($('#password_confirmation').val() === ""){
        (new bootstrap.Toast('#myToast6', { delay: 10000 })).show();
        $('#password_confirmation').addClass('error-message');
        isValid = false;
    }else if($('#password_confirmation').val().length < 8){
        (new bootstrap.Toast('#myToast7', { delay: 10000 })).show();
        $('#password_confirmation').addClass('error-message');
        isValid = false;
    }else if($('#password').val() !== $('#password_confirmation').val()){
        (new bootstrap.Toast('#myToast5', { delay: 10000 })).show();
        $('#password, #password_confirmation').addClass('error-message');
        isValid = false;
    }else
        $('#password_confirmation').removeClass('error-message');

    if ($('#codePassword').val() === ""){
        (new bootstrap.Toast('#myToast8', { delay: 10000 })).show();
        $('#codePassword').addClass('error-message');
        isValid = false;
    }else if($('#codePassword').val().length < 8){
        (new bootstrap.Toast('#myToast9', { delay: 10000 })).show();
        $('#codePassword').addClass('error-message');
        isValid = false;
    }else
        $('#codePassword').removeClass('error-message');
        
    return isValid;
}