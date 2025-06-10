function getLanguage(){
    let item;
    $('.flexCheck').each(function(idx, el){
        if(el.checked){
            item = el.value;
            return;
        }
    });
    return item;
}
function closeModel(lang, id){
        closeForm(id);
        if(lang != getLanguage())
            $('.flexCheck').each(function(idx, el){
        el.checked = el.value != lang ? false:true;
    });
}
function setLanguage(element){
    $('.flexCheck').each(function(idx, el){
        el.checked = element != el ? false:true;
    });
}
function IsEmail(email) {
    const regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}
function isPhone(phone) {
    const regex = /^([0-9]{11})+$/;
    if (!regex.test(phone)) {
        return false;
    }
    else {
        return true;
    }
}
//delete this function after change code
function deleteModelDisplay(valueDelete, id){
    $('#deleteValue').text(' ' + valueDelete);
    $('#index').val(id);
    openForm('modalDelete');
}
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
        if($(this).val() === inputOutputLabTest)
            $(this).prop('selected', true);
    });
}
function validateForm(name, shortcut, price, inputOutputLab){
    isValid = true;
     if(name.val() === '' || name.val().length < 3){
        (new bootstrap.Toast($(name.val() === '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        name.addClass('error-message');
        isValid = false;
    }else
        name.removeClass('error-message');
    if(shortcut.val() === '' || shortcut.val().length < 3){
        (new bootstrap.Toast($(shortcut.val() === '' ? '#myToast3' : '#myToast4'), { delay: 10000 })).show();
        shortcut.addClass('error-message');
        isValid = false;
    }else
        shortcut.removeClass('error-message');
    if(price.val() === ''){
        (new bootstrap.Toast($('#myToast5'), { delay: 10000 })).show();
        price.addClass('error-message');
        isValid = false;
    }else
        price.removeClass('error-message');
    if(inputOutputLab.val() === null){
        (new bootstrap.Toast($('#myToast6'), { delay: 10000 })).show();
        inputOutputLab.addClass('error-message');
        isValid = false;
    }else
        inputOutputLab.removeClass('error-message');
    return isValid;
}
function openForm(id){
    $('#'+id).modal('show');
}
function closeForm(id){
    $('#'+id).modal('hide');
}
function createToast(message, type){
    const $toastContainer = $("#toastContainer");

    // Create the toast element
    const $toast = $(`
    <div class="toast align-items-center text-bg-${type} border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">${message}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    `);

    // Append the toast to the container
    $toastContainer.append($toast);

    // Initialize and show the toast
    const toast = new bootstrap.Toast($toast[0]);
    toast.show();

    // Remove the toast from DOM when hidden
    $toast.on("hidden.bs.toast", function () {
    $(this).remove();
    });
};
$(document).ready(function () {
    $('input[type="number"]').on('keydown', function (event) {
        // Prevent 'e', 'E', '-', '+'
        if (['e', 'E', '-', '+'].includes(event.key)) {
            event.preventDefault();
        }
    });
});
function openDatePicker(date) {
  date.showPicker(); // Opens the date picker on click
}