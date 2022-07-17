$('input[name=bonus]').on('ifChanged', function () {
    if ($(this).is(":checked")) {
        toggleBonusContractDiv(true);
        setPayslipName();
        setReferenceField();
    } else {
        toggleBonusContractDiv(false);
        setPayslipName();
        setReferenceField();
    }
});

function toggleBonusContractDiv(show = true) {
    if (show) {
        $('.bonus-contract-div').show();
    } else {
        $('.bonus-contract-div').hide();
    }
}


function setReferenceField() {
    let uniqueId = getEmployeeUniqueId();
    let [month, year] = getDateMetadata();
    let header = 'PAYSLIP/BARD/';
    if (isBonusChecked()) {
        header = 'PAYSLIP/BARD/BONUS/'
    }
    let text = header + uniqueId + '/' + month + '/' + year;
    $('#reference').val(text);
}

function isBonusChecked() {
    checked = $("#bonus").prop("checked");
    return checked;
}

function setPayslipName() {
    let title = getEmployeeName();
    let [month, year] = getDateMetadata();
    let header = 'Salary Slip ';
    if (isBonusChecked()) {
        header = 'Bonus Slip ';
    }
    let payslipName = header + `of ${title} for ${month.toLocaleString("en-us", {month: "long"})},${year}`;
    $('input[name=payslip_name]').val(payslipName);
}

function getDateMetadata() {
    let selectedDate = new Date(periodTo.pickadate('picker').get('select', 'yyyy-mm-dd'));
    let month = selectedDate.toLocaleString("en-us", {month: "long"});
    let year = selectedDate.getFullYear();
    return [month, year];
}

function initDateField() {
    periodFrom.pickadate('picker').set('select', [year, month, 1]);
    periodTo.pickadate('picker').set('select', [year, month + 1, 0])
}

function changePeriodToDate(obj) {
    let selectedDate = new Date(obj.get('select', 'yyyy-mm-dd'));
    setEmployeeSelect2();
    month = selectedDate.getMonth();
    year = selectedDate.getFullYear();
    periodTo.pickadate('picker')
        .set('min', [year, month, 1])
        .set('max', [year, month + 1, 0])
        .set('select', [year, month + 1, 0]);
}

function getEmployeeName() {
    fullName = $('.employee-select').find('option:selected').html().trim();
    let names = fullName.split('-');
    return names[1];

}

function getEmployeeUniqueId() {
    fullName = $('.employee-select').find('option:selected').html().trim();
    let names = fullName.split('-');
    return names[0];
}

function setEmployeeSelect2() {
    $('.employee-select').val('select').select2({  // select2 initialization
        placeholder: selectPlaceholder,
    });
}


