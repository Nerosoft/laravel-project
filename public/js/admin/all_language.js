function save(el){
    if($(el).find('#word').val() === ""){
        (new bootstrap.Toast('#myToast1', { delay: 10000 })).show();
        $(el).find('#word').addClass('error-message');
        return false;
    }else if($(el).find('#word').val().length < 2){
        (new bootstrap.Toast('#myToast2', { delay: 10000 })).show();
        $(el).find('#word').addClass('error-message');
        return false;
    }else
        return true;
}
function displayEditForm(id, inputValue, value){
    openForm(id);
    inputValue.val(value);
    inputValue.removeClass('error-message');
}
function displayEditForm2(id, selectBox, value){
    openForm(id);
    selectBox.each(function(idx, el){
        if($(this).val() === value)
            $(this).prop('selected', true);
    });
}
