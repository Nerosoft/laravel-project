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