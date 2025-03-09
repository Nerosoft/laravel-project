function validateForm(){
  if ($('#patientCode').val() === "" || $('#patientCode').val().length < 3) {
    (new bootstrap.Toast($($('#patientCode').val() !== '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
    $('#patientCode').addClass('error-message');
    return false;
  }
  else
      return true;
}
