let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];
function validateCurrentOffers(name, shortcut, price, display_price, state){
    isValid = validateForm2(name, shortcut, price);
    if(display_price.val() === ''){
        (new bootstrap.Toast($('#myToast6'), { delay: 10000 })).show();
        display_price.addClass('error-message');
        isValid = false;
    }else
        display_price.removeClass('error-message');    
    if(state.val() === null){
        (new bootstrap.Toast($('#myToast7'), { delay: 10000 })).show();
        state.addClass('error-message');
        isValid = false;
    }else
        state.removeClass('error-message');
    return isValid;   
}
function displayEditFormOffer(name, shortcut, price, display_price, state, id, nameTest, shortcutTest, priceTest, displayPriceTest, stateTest){
    //call model edit
    openForm(id);
    //clear all error
    name.removeClass('error-message');
    shortcut.removeClass('error-message');
    price.removeClass('error-message');
    display_price.removeClass('error-message');
    //reset all value of input if user edit or creare value
    name.val(nameTest);
    shortcut.val(shortcutTest);
    price.val(priceTest);
    display_price.val(displayPriceTest);
    state.each(function(idx, el){
        if($(this).val() === stateTest)
            $(this).prop('selected', true);
    });
}