let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];

function displayEditForm(id, name, shortcut, price, input_output_lab, nameTset, shortcutTest, priceTest, inputOutputLabTest){
    //call model using id
    openForm(id);
    //clear all error
    name.removeClass('error-message');
    shortcut.removeClass('error-message');
    price.removeClass('error-message');
    //reset all value of input if user edit or creare value
    name.val(nameTset);
    shortcut.val(shortcutTest);
    price.val(priceTest);
    input_output_lab.each(function(idx, el){
        if($(this).html() === inputOutputLabTest)
            $(this).prop('selected', true);
    });
}

function validateForm(name, shortcut, price, inputOutputLab){
    isValid = true;
     if(name.val() === ''){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        name.addClass('error-message');
        isValid = false;
    }else if(name.val().length < 3){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        name.addClass('error-message');
        isValid = false;
    }else
        name.removeClass('error-message');
    if(shortcut.val() === ''){
        (new bootstrap.Toast('#myToast3', { delay: 10000 })).show();
        shortcut.addClass('error-message');
        isValid = false;
    }else if(shortcut.val().length < 3){
        (new bootstrap.Toast('#myToast4', { delay: 10000 })).show();
        shortcut.addClass('error-message');
        isValid = false;
    }else
        shortcut.removeClass('error-message');
    if(price.val() === ''){
        (new bootstrap.Toast('#myToast5', { delay: 10000 })).show();
        price.addClass('error-message');
        isValid = false;
    }else
        price.removeClass('error-message');
    if(inputOutputLab.val() === null){
        (new bootstrap.Toast('#myToast6', { delay: 10000 })).show();
        inputOutputLab.addClass('error-message');
        isValid = false;
    }else
        inputOutputLab.removeClass('error-message');
    return isValid;
}