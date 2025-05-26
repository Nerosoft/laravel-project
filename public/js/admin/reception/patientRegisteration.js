let setting = [
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
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false, className: "text-left" },
];
function clearValue(form, url){
    $(form).find('#patent-code').val("");
    $(form).find('#patent-name').val("");
    $(form).find('#patent-nationality').val("");
    $(form).find('#patent-gender').val("");
    $(form).find('#patent-contracting').val("");
    $(form).find('#patent-national-id').val("");
    $(form).find('#patent-passport-no').val("");
    $(form).find('#patent-email').val("");
    $(form).find('#patent-phone').val("");
    $(form).find('#patent-phone2').val("");
    $(form).find('#patent-address').val("");
    $(form).find('#patent-hours').val("");
    $(form).find('#last-period-date').val("");
    $(form).find('#date-birth').val("");
    $(form).find('#patent-other').val("");
    //get image preview
    $(form).find('#preview').attr("src", url);
    $(form).find('input[type="checkbox"]').each(function () {
        this.checked = false;
    });
}
function initPatient(el, form, url){
    clearValue(form, url);
    //Convert JSON string to a JavaScript object
    const jsonObject = JSON.parse(el.value);
    $(form).find('#patent-code').val(jsonObject.PatentCode);
    $(form).find('#patent-name').val(jsonObject.Name);
    $(form).find('#patent-nationality').val(jsonObject.Nationality);
    $(form).find('#patent-gender').val(jsonObject.Gender);
    $(form).find('#patent-contracting').val(jsonObject.Contracting);
    $(form).find('#patent-national-id').val(jsonObject.NationalId);
    $(form).find('#patent-passport-no').val(jsonObject.PassportNo);
    $(form).find('#patent-email').val(jsonObject.Email);
    $(form).find('#patent-phone').val(jsonObject.Phone);
    $(form).find('#patent-phone2').val(jsonObject.Phone2);
    $(form).find('#patent-address').val(jsonObject.Address);
    $(form).find('#patent-hours').val(jsonObject.Hours);
    $(form).find('#last-period-date').val(jsonObject.LastPeriodDate);
    $(form).find('#date-birth').val(jsonObject.DateBirth);
    //get image preview
    if(jsonObject.Avatar != null)
        $(form).find('#preview').attr("src", jsonObject.Avatar);
    
    if(typeof jsonObject.Disease === 'object'){
        let myKeys = Object.keys(jsonObject.Disease);
        $(form).find('input[type="checkbox"]').each(function(idx, el){
            el.checked = myKeys[idx] === el.value ? true : false;
        });
    }
    else
        $(form).find('#patent-other').val(jsonObject.Disease);

}


async function openPDF(url, titleReceipt, label29, label30, label31, label32, label33, label34, label35, label36, label37, label38, label39, label40, label41, label42, label43, numberReceipt, dateReceipt, namePatient, codePatient, allTests, egp, Subtotal, TotalDiscount, Total, PaymentDate, AmountPaid, PaymentMethod, Due) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: "portrait",
        unit: "mm",
        format: [100, 350] // Custom page size: 120mm width and 180mm height
    });
    // Set custom PDF metadata
    doc.setProperties({
        title: titleReceipt,
    });
    // Add a logo image
    const logo = await fetch(url)
        .then(res => res.blob())
        .then(blob => {
            return new Promise(resolve => {
                const reader = new FileReader();
                reader.onload = () => resolve(reader.result);
                reader.readAsDataURL(blob);
            });
        });
    // Centered logo
    const pageWidth = 100;
    const logoWidth = 55;
    const logoHeight = 55;
    const logoX = (pageWidth - logoWidth) / 2;
    const logoY = 10;
    doc.addImage(logo, "PNG", logoX, logoY, logoWidth, logoHeight);
    // Title and subtitle
    const textWidth = doc.getStringUnitWidth(label43) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const textX = (pageWidth - textWidth) / 2;
    doc.setFont("helvetica", "bold");
    doc.setFontSize(14);
    doc.text(label43, textX +30, logoY + logoHeight + 5, { maxWidth: pageWidth -30 });
    // Loop through the additional information and center each line
    let yPosition = logoY + logoHeight + 25;
    [
        { label: label29, value: numberReceipt },
        { label: label30, value: dateReceipt },
        { label: label31, value: namePatient },
        { label: label32, value: codePatient },
    ].forEach(item => {
        const labelWidth = doc.getStringUnitWidth(item.label) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const valueWidth = doc.getStringUnitWidth(item.value) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const totalWidth = labelWidth + valueWidth + 10; // Space between label and value
        const labelX = (pageWidth - totalWidth) / 2;   
        doc.setFont("helvetica", "bold");
        doc.text(item.label, labelX, yPosition); // Label
        doc.setFont("helvetica", "normal");
        doc.text(item.value, labelX + labelWidth + 5, yPosition); // Value
        yPosition += 10; // Increase Y position for the next line
    });
    // Draw a line separator
    const finalY = yPosition - 1; // Position before the additional info
    doc.setDrawColor(0); // Black line color
    doc.setLineWidth(0.5); // Thin line
    doc.line(10, finalY, pageWidth - 10, finalY); // Line from left to right
    let yPosition2 = finalY + 13; // Start position for additional info
    allTests.reduce(function(acc, item){
        return Array.isArray(acc) ? [...acc, { label: item.Shortcut, value: item.Price +" "+ egp }] : new Array({ label: label33, value: label34 }, { label: item.Shortcut, value: item.Price +" "+ egp });
    }, 0).forEach(function(item, index){
        const labelWidth = doc.getStringUnitWidth(item.label) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const valueWidth = doc.getStringUnitWidth(item.value) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const totalWidth = labelWidth + valueWidth + 10; // Space between label and value
        const labelX = (pageWidth - totalWidth) / 2;    
        doc.setFont("helvetica", "bold");
        doc.text(item.label, labelX, yPosition2); // Label
        doc.setFont("helvetica", index !== 0 ? "normal" : "bold");
        doc.text(item.value, labelX + labelWidth + 5, yPosition2); // Value
        yPosition2 += 10; // Increase Y position for the next line
    });
    // Draw a line separator
    const finalY2 = yPosition2 - 1; // Position before the additional info
    doc.setDrawColor(0); // Black line color
    doc.setLineWidth(0.5); // Thin line
    doc.line(10, finalY2, pageWidth - 10, finalY2); // Line from left to right
    let yPosition3 = finalY2 + 13; // Start position for additional info
    [
        { label: label35, value: Subtotal + " " + egp},
        { label: label36, value: TotalDiscount + " " + egp},
        { label: label37, value: Total + " " + egp},
    ].forEach(item => {
        const labelWidth = doc.getStringUnitWidth(item.label) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const valueWidth = doc.getStringUnitWidth(item.value) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const totalWidth = labelWidth + valueWidth + 10; // Space between label and value
        const labelX = (pageWidth - totalWidth) / 2;   
        doc.setFont("helvetica", "bold");
        doc.text(item.label, labelX, yPosition3); // Label
        doc.setFont("helvetica", "normal");
        doc.text(item.value, labelX + labelWidth + 5, yPosition3); // Value
        yPosition3 += 10; // Increase Y position for the next line
    });
     // Draw a line separator
    const finalY3 = yPosition3 - 1; // Position before the additional info
    doc.setDrawColor(0); // Black line color
    doc.setLineWidth(0.5); // Thin line
    doc.line(10, finalY3, pageWidth - 10, finalY3); // Line from left to right
    let yPosition4 = finalY3 + 13; // Start position for additional info
    [
        { label: label38, value: PaymentDate },
        { label: label39, value: AmountPaid + " " + egp},
        { label: label40, value: PaymentMethod },
        { label: label41, value: Due + " " + egp},
    ].forEach(item => {
        const labelWidth = doc.getStringUnitWidth(item.label) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const valueWidth = doc.getStringUnitWidth(item.value) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        const totalWidth = labelWidth + valueWidth + 10; // Space between label and value
        const labelX = (pageWidth - totalWidth) / 2;     
        doc.setFont("helvetica", "bold");
        doc.text(item.label, labelX, yPosition4); // Label
        doc.setFont("helvetica", "normal");
        doc.text(item.value, labelX + labelWidth + 5, yPosition4); // Value
        yPosition4 += 10; // Increase Y position for the next line
    });
    const finalY4 = yPosition4 - 1; // Position before the additional info
    doc.setDrawColor(0); // Black line color
    doc.setLineWidth(0.5); // Thin line
    doc.line(10, finalY4, pageWidth - 10, finalY4); // Line from left to right
    doc.setFont("helvetica", "italic");
    doc.setFontSize(12);
    doc.text(label42, 10, finalY4 + 10, { maxWidth: pageWidth - 20 });
    // Create a Blob from the PDF Open the PDF in a new browser tab
    const pdfURL = URL.createObjectURL(doc.output("blob"));
    window.open(pdfURL, "_blank");
}

$(document).ready(function() {
     // Optional: Prevent the user from entering a value greater than 100 using jQuery
     $('#discount').on('input', function() {
        if ($(this).val() > 100)
            $(this).val(100); // Set value to 100 if it exceeds 100    
        else if ($(this).val() <= 0)
            $(this).val(0); // Set value to 100 if it exceeds 100
    });
     $('#delayedMoney').on('input', function() {
        if ($(this).val() <= 0)
            $(this).val(0); // Set value to 100 if it exceeds 100
    });
});
function displayEditForm(test_select, payment_date, payment_amount, form_check_input, patent_other, preview, selectPatient, patent_code, patent_name, patent_nationality, patent_national_id, patent_passport_no, patent_email, patent_phone, patent_phone2, patent_gender, last_period_date, date_birth, patent_address, patent_contracting, patent_hours, know_option, subtotalELement, discountElement, totalDiscountElement, totalElement, paidElement, dueElement, delayedMoneyElement, dueUserElement, payment_method_option, items_table_tbody, id, key, button1, egp, myAvatar, myPatientName, myPatentCode, myNationality, myNationalId, myPassportNo, myEmail, myPhone, myPhone2, myGender, myLastPeriodDate, myDateBirth, myAddress, myContracting, myHours, myDisease, myKnow, myTest, Subtotal, Discount, TotalDiscount, Total, AmountPaid, Due, DelayedMoney, DueUser, PaymentDate, PaymentMethod){
    openForm(id);
    test_select.removeClass('error-message');
    payment_date.removeClass('error-message');
    payment_amount.removeClass('error-message');
    form_check_input.each(function(idx, el){
        el.checked = false;
    });
    patent_other.val('');
    //-----------------------------------------------
    preview.attr('src', myAvatar);
    selectPatient.each(function(idx, el){
        if(idx !== 0)
            if(JSON.parse($(this).val()).PatentCode === myPatentCode)
                $(this).prop('selected', true);
    });
    patent_code.val(myPatentCode);
    patent_name.val(myPatientName);
    patent_nationality.val(myNationality);
    patent_national_id.val(myNationalId);
    patent_passport_no.val(myPassportNo);
    patent_email.val(myEmail);
    patent_phone.val(myPhone);
    patent_phone2.val(myPhone2);
    patent_gender.val(myGender);
    last_period_date.val(myLastPeriodDate);
    date_birth.val(myDateBirth);
    patent_address.val(myAddress);
    patent_contracting.val(myContracting);
    patent_hours.val(myHours);
    if(typeof myDisease === 'object'){
        let myKeys = Object.keys(myDisease);
        form_check_input.each(function(idx, el){
        el.checked = myKeys[idx] === el.value ? true : false;
        });
    }
    else
        patent_other.val(myDisease);
    know_option.each(function(idx, el){
        if($(this).html() === myKnow)
            $(this).prop('selected', true);
    });
    subtotalELement.text(egp + " " + Subtotal);
    discountElement.val(Discount);
    totalDiscountElement.text(egp + " " + TotalDiscount);
    totalElement.text(egp + " " + Total);
    paidElement.text(egp + " " + AmountPaid);
    dueElement.text(egp + " " + Due);
    //delayedMoney and payment-amount have same value
    delayedMoneyElement.val(DelayedMoney);
    dueUserElement.text(egp + " " + DueUser);
    payment_date.val(PaymentDate);
    payment_amount.val(AmountPaid);
    payment_method_option.each(function(idx, el){
        if($(this).html() === PaymentMethod)
          $(this).prop('selected', true);
    });
    keyValueMap.set(key, myTest);
    writeTable(egp, button1, key, items_table_tbody, subtotalELement, totalDiscountElement, discountElement.val(), totalElement, dueElement, payment_amount.val(), dueUserElement);    
}

function writeTable(egp, button1, key, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser){
    table.empty();
    keyValueMap.get(key).forEach((item, index) => {
    table.append($(`
            <tr>
                <td>${item.Name}</td>
                <td>${item.Shortcut}</td>
                <td>${item.Price}</td>
                <td>${item.InputOutputLab}</td>
                <td>
                    <button id="${index}" class="btn btn-danger btn-sm delete-item" type="button">
                        <i class="bi bi-trash"></i> ${button1}
                    </button>
                </td>
            </tr>
        `)).find('#'+index).on('click', function () {
            //call method delete row inside table
            deleteRowTable(key, index, egp, button1, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser);
        });
    });
}
// Function to update the receipt calculations
function myUpdateReceipt(subtotal, totalDiscount, discount, total, due, payment_amount, dueUser, egp, combinedArray) {
    subtotal.text(egp + " " + combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0));
    totalDiscount.text(egp + " " + parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100)));
    total.text(egp + " " + (parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0)) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100))));
    due.text(egp + " " + 
        parseInt(parseInt(payment_amount) <= 0 || payment_amount === ''?
         (combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount) / 100)) 
         : 
         parseInt(payment_amount) <= (combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100))) ?
          (combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100))) - parseInt(payment_amount) : '0'
    ));
    dueUser.text(egp + " " + parseInt(
        parseInt(payment_amount) > (combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100))) ? 
        parseInt(payment_amount) - (combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100))) : '0'
    ));
}

function myUpdatePrice(value, egp, paid, discount, due, dueUser, combinedArray){
    paid.text(egp + " " + value);
    let total = (parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0)) - parseInt(combinedArray.reduce((acc, item) => parseInt(acc) + parseInt(item.Price), 0) * (discount / 100)));
    if(value < total && total > 0){
        due.text(egp + " " + parseInt(total - value));
        dueUser.text(egp + " 0");
    }else{
        due.text(egp + " 0");
        dueUser.text(egp + " " + parseInt(total === 0   ? "0" : (value - total)));
    }
}

function addItem3(test_select, tests_name, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser, key, egp, button1){
    if(test_select.val() === null){
        (new bootstrap.Toast($('#myToast1'), { delay: 10000 })).show();
        (new bootstrap.Toast($('#myToast2'), { delay: 10000 })).show();
        test_select.addClass('error-message');
    }
    else if(tests_name.val() === null){
        test_select.addClass('error-message');
        (new bootstrap.Toast($('#myToast1'), { delay: 10000 })).show();
        (new bootstrap.Toast($('#myToast2'), { delay: 10000 })).show();
    }
    else{
        //check if has class test-select and tests-name
        test_select.removeClass('error-message');
        tests_name.removeClass('error-message');
        let obj = JSON.parse(tests_name.val());
        keyValueMap.get(key).push({
            Name:obj.Name,
            Shortcut: obj.Shortcut,
            Price: obj.Price,
            InputOutputLab: obj.InputOutputLab,
            Id:obj.Id
        });
        writeTable(egp, button1, key, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser);
        myUpdateReceipt(subtotal, totalDiscount, discount, total, due, payment_amount, dueUser, egp, keyValueMap.get(key));
    }
}

function handleChange2(idSelectBox, idHeddinSelectBox, event, test, Cultures, packageCultures){
    idHeddinSelectBox.empty(); // Clear all existing options
    idSelectBox.removeClass('d-none');
    if(event.target.value === 'Test' && test !== null)
        for (let key in test)
            idHeddinSelectBox.append(`<option value='${JSON.stringify(test[key])}'>${test[key].Name}</option>`);
    //package
    else if(event.target.value === 'Packages' && packageCultures !== null)
        for (let key in packageCultures)
            idHeddinSelectBox.append(`<option value='${JSON.stringify(packageCultures[key])}'>${packageCultures[key].Name}</option>`);
    //Cultures
    else if(event.target.value === 'Cultures' && Cultures !== null)
        for (let key in Cultures)
            idHeddinSelectBox.append(`<option value='${JSON.stringify(Cultures[key])}'>${Cultures[key].Name}</option>`);
    else 
        idSelectBox.attr("class", "d-none");
}

function validateT2(test_select, tests_name, selectPatient, know, payment_date, payment_amount, payment_method, patent_code, discount, delayedMoney, key, url, message, state){
    let isValid = false;
    if(test_select.val() === null && keyValueMap.get(key).length === 0){
        (new bootstrap.Toast($('#myToast1'), { delay: 10000 })).show();
        test_select.addClass('error-message');
        isValid = true;
    }
    else
        test_select.removeClass('error-message');

    if(tests_name === null && keyValueMap.get(key).length === 0){
        (new bootstrap.Toast($('#myToast2'), { delay: 10000 })).show();
        test_select.addClass('error-message');
        isValid = true;
    }
    else
        test_select.removeClass('error-message');

    if(selectPatient.val() === null){
        (new bootstrap.Toast($('#myToast3'), { delay: 10000 })).show();
        selectPatient.addClass('error-message');
        isValid = true;
    }
    else
        selectPatient.removeClass('error-message');
    if(know.val() === null){
        (new bootstrap.Toast($('#myToast4'), { delay: 10000 })).show();
        know.addClass('error-message');
        isValid = true;
    }
    else
        know.removeClass('error-message');

    if(keyValueMap.get(key).length === 0){
        (new bootstrap.Toast($('#myToast5'), { delay: 10000 })).show();
        isValid = true;
    }
    if(!(/^\d{4}-\d{2}-\d{2}$/).test(payment_date.val())){
        (new bootstrap.Toast($('#myToast6'), { delay: 10000 })).show();
        payment_date.addClass('error-message');
        isValid = true;
    }
    else
        payment_date.removeClass('error-message');


    if(payment_amount.val() === ''){
        (new bootstrap.Toast($('#myToast7'), { delay: 10000 })).show();
        payment_amount.addClass('error-message');
        isValid = true;
    }
    else
        payment_amount.removeClass('error-message');

    if(payment_method.val() === null){
        (new bootstrap.Toast($('#myToast8'), { delay: 10000 })).show();
        payment_method.addClass('error-message');
        isValid = true;
    }
    else
        payment_method.removeClass('error-message');

    if(isValid)
        return false;

   
   
    let data = state !== 'create' ? {
        item: keyValueMap.get(key).map(test => test.Id),
        patentCode: patent_code,
        know: know.val(),
        discount: discount,
        delayedMoney: delayedMoney,
        paymentDate: payment_date.val(),
        paymentAmount: payment_amount.val(),
        paymentMethod: payment_method.val(),
        id: key,
        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
    } : {
        item: keyValueMap.get(key).map(test => test.Id),
        patentCode: patent_code,
        know: know.val(),
        discount: discount,
        delayedMoney: delayedMoney,
        paymentDate: payment_date.val(),
        paymentAmount: payment_amount.val(),
        paymentMethod: payment_method.val(),
        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
    };

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        success: function (response) {
            // window.location.href = message;
            $('#myToastActionBody').text(response['message']);
            (new bootstrap.Toast($('#myToastAction'), { delay: 10000 })).show();
            setTimeout(() => {
                window.location.href = message;
            }, 1000);
        },
        error: function (xhr) {
            const errors = xhr.responseJSON.errors;
            for (const key in errors) 
                createToast(errors[key][0], 'danger');
        }
    });
    return false;
}

function deleteRowTable(key, index, egp, button1, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser){
    keyValueMap.get(key).splice(index, 1); // Remove the item from the items array
    writeTable(egp, button1, key, table, subtotal, totalDiscount, discount, total, due, payment_amount, dueUser);
    myUpdateReceipt(subtotal, totalDiscount, discount, total, due, payment_amount, dueUser, egp, keyValueMap.get(key));  
}