let setting = [
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': false, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': true, className: "text-left" },
  { 'searchable': false, className: "text-left" },
];
function validatePatent(patent_name, patent_nationality, patent_gender, patent_contracting, patent_national_id, patent_passport_no, patent_email, patent_phone, patent_phone2, patent_address, patent_hours, patent_other, checkBoxLength, last_period_date, date_birth, file, preview){
      let isValid = true;
      if (patent_name.val() === "" || patent_name.val().length < 3){
        (new bootstrap.Toast($(patent_name.val() === '' ? '#myToast1' : '#myToast2'), { delay: 10000 })).show();
        patent_name.addClass('error-message');
          isValid = false;
      }else
        patent_name.removeClass('error-message');
      if (patent_nationality.val() === null){
        (new bootstrap.Toast($('#myToast3'), { delay: 10000 })).show();
        patent_nationality.addClass('error-message');
          isValid = false;
      }else 
        patent_nationality.removeClass('error-message');

      if (patent_gender.val() === null){
        (new bootstrap.Toast($('#myToast4'), { delay: 10000 })).show();
        patent_gender.addClass('error-message');
          isValid = false;
      }else
        patent_gender.removeClass('error-message');

      if (patent_contracting.val() === null){
        (new bootstrap.Toast($('#myToast5'), { delay: 10000 })).show();
        patent_contracting.addClass('error-message');
          isValid = false;
      }else
        patent_contracting.removeClass('error-message');

      if (patent_national_id.val() === "" || patent_national_id.val().length < 3){
        (new bootstrap.Toast($(patent_national_id.val() === '' ? '#myToast6' : '#myToast7'), { delay: 10000 })).show();
        patent_national_id.addClass('error-message');
          isValid = false;
      }else
        patent_national_id.removeClass('error-message');

      if (patent_passport_no.val() === "" || patent_passport_no.val().length < 3){
        (new bootstrap.Toast($(patent_passport_no.val() === '' ? '#myToast8' : '#myToast9'), { delay: 10000 })).show();
        patent_passport_no.addClass('error-message');
          isValid = false;
      }else 
        patent_passport_no.removeClass('error-message');

      if (patent_email.val() === "" || (!IsEmail(patent_email.val()))){
        (new bootstrap.Toast($(patent_email.val() === "" ? '#myToast10' : '#myToast11'), { delay: 10000 })).show();
        patent_email.addClass('error-message');
          isValid = false;
      }else
        patent_email.removeClass('error-message');

      if (patent_phone.val() === "" || (!isPhone(patent_phone.val()))){
        (new bootstrap.Toast($(patent_phone.val() === '' ? '#myToast12' : '#myToast13'), { delay: 10000 })).show();
        patent_phone.addClass('error-message');
        isValid = false;
      }else 
        patent_phone.removeClass('error-message');

      if (patent_phone2.val() === "" || (!isPhone(patent_phone2.val()))){
        (new bootstrap.Toast($(patent_phone2.val() === '' ? '#myToast14' : '#myToast15'), { delay: 10000 })).show();
        patent_phone2.addClass('error-message');
        isValid = false;
      }else
        patent_phone2.removeClass('error-message');

      if (patent_address.val() === "" || patent_address.val().length < 3){
        (new bootstrap.Toast($(patent_address.val() === '' ? '#myToast16' : '#myToast17'), { delay: 10000 })).show();
        patent_address.addClass('error-message');
        isValid = false;
      }else
        patent_address.removeClass('error-message');

      if (patent_hours.val() === ""){
        (new bootstrap.Toast($('#myToast18'), { delay: 10000 })).show();
        patent_hours.addClass('error-message');
        isValid = false;
      }else
        patent_hours.removeClass('error-message');

      if (patent_other.val() !== "" && checkBoxLength >= 1 || patent_other.val() === "" && checkBoxLength === 0 || patent_other.val().length < 3 && checkBoxLength === 0 || patent_other.val().length >= 1 && patent_other.val().length < 3 && checkBoxLength >= 1){
        (new bootstrap.Toast($(patent_other.val() === '' ? '#myToast19' : '#myToast20'), { delay: 10000 })).show();
        patent_other.addClass('error-message');
        isValid = false;
      }else
        patent_other.removeClass('error-message');

       // Check if the input matches the date format
      if (!(/^\d{4}-\d{2}-\d{2}$/).test(last_period_date.val())) {
        (new bootstrap.Toast($('#myToast21'), { delay: 10000 })).show();
        last_period_date.addClass('error-message');
        isValid = false;
      }else
        last_period_date.removeClass('error-message');

      // Check if the input matches the date format
      if (!(/^\d{4}-\d{2}-\d{2}$/).test(date_birth.val())) {
        (new bootstrap.Toast($('#myToast22'), { delay: 10000 })).show();
        date_birth.addClass('error-message');
        isValid = false;
      }else
        date_birth.removeClass('error-message');


      if(file && file.type !== 'image/jpeg' && file.type !== 'image/png' && file.type !== 'image/gif'){
        (new bootstrap.Toast($('#myToast23'), { delay: 10000 })).show();
        preview.addClass('error-message');
        isValid = false;
      }else if(file && file.size > 1048576){
        (new bootstrap.Toast($('#myToast24'), { delay: 10000 })).show();
        preview.addClass('error-message');
        isValid = false;
      }else
        preview.removeClass('error-message');

      return isValid;
}
function displayEditForm(patent_name, patent_nationality, patent_gender, patent_contracting, patent_national_id, patent_passport_no, patent_email, patent_phone, patent_phone2, patent_address, patent_hours, patent_other, last_period_date, date_birth, preview, form_check_input, avatar, id, myDisease, myAvatar, myName, myNationality, myNationalId, myPassportNo, myEmail, myPhone, myPhone2, myGender, myLastPeriodDate, myDateBirth, myAddress, myContracting, myHours){
  //call model
  openForm(id);
  patent_name.removeClass('error-message');
  patent_nationality.removeClass('error-message');
  patent_gender.removeClass('error-message');
  patent_contracting.removeClass('error-message');
  patent_national_id.removeClass('error-message');
  patent_passport_no.removeClass('error-message');
  patent_email.removeClass('error-message');
  patent_phone.removeClass('error-message');
  patent_phone2.removeClass('error-message');
  patent_address.removeClass('error-message');
  patent_hours.removeClass('error-message');
  patent_other.removeClass('error-message');
  last_period_date.removeClass('error-message');
  date_birth.removeClass('error-message');
  preview.removeClass('error-message');
  form_check_input.each(function(idx, el){
    el.checked = false;
  });
  patent_other.val('');

  //-------------------------------------------------------
  //resit input image
  avatar.val('');
  preview.attr('src', myAvatar);
  patent_name.val(myName);
  patent_nationality.find('option').each(function(idx, el){
    if($(this).val() === myNationality)
      $(this).prop('selected', true);
  });
  patent_national_id.val(myNationalId);
  patent_passport_no.val(myPassportNo);
  patent_email.val(myEmail);
  patent_phone.val(myPhone);
  patent_phone2.val(myPhone2);
  patent_gender.find('option').each(function(idx, el){
    if($(this).val() === myGender)
      $(this).prop('selected', true);
  });
  last_period_date.val(myLastPeriodDate);
  date_birth.val(myDateBirth);
  patent_address.val(myAddress);
  patent_contracting.find('option').each(function(idx, el){
    if($(this).val() === myContracting)
      $(this).prop('selected', true);
  });
  patent_hours.val(myHours);
  if(Array.isArray(myDisease))
    form_check_input.each(function(idx, el){
      el.checked = myDisease.includes(el.value) ? true : false;
    });
  else
    patent_other.val(myDisease);
}
function openImage(avatar, preview){
  avatar.click();
  avatar.on('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
    }
  }); 
}
function displayImage(id){
  openForm(id);
}