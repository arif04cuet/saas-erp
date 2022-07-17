$('input[name=bonus]').on('ifChanged', function () {
    if ($(this).is(":checked")) {
        toggleBonusContractDiv(true);
        initField(true);
    } else {
        toggleBonusContractDiv(false);
        initField();
    }
});

function toggleBonusContractDiv(show = true) {
    if (show) {
        $('.bonus-structure-div').show();
    } else {
        $('.bonus-structure-div').hide();
    }
}


function initField(bonus = false) {
    let [month, year] = getDateMetadata();
    var name, reference;
    //name field
    if (bonus) {
        name = `Bonus Slip for ${month.toLocaleString("en-us", {month: "long"})},${year}`;
    } else {
        name = `Salary Slip for ${month.toLocaleString("en-us", {month: "long"})},${year}`;
    }
    //ref field
    if (bonus) {
        reference = `PAYSLIP-BATCH/BARD/BONUS/${month.toLocaleString("en-us", {month: "long"})}/${year}`;
    } else {
        reference = `PAYSLIP-BATCH/BARD/${month.toLocaleString("en-us", {month: "long"})}/${year}`;
    }

    setPayslipName(month, year, name);
    setReferenceField(month, year, reference);
}

function getDateMetadata() {
    let selectedDate = new Date(periodTo.pickadate('picker').get('select', 'yyyy-mm-dd'));
    let month = selectedDate.toLocaleString("en-us", {month: "long"});
    let year = selectedDate.getFullYear();
    return [month, year];
}

function setPayslipName(month, year, name) {
    $('input[name=name]').val(name);
}

function setReferenceField(month, year, reference) {
    $('input[name=reference]').val(reference);
}

function changePeriodToDate(obj) {
    let selectedDate = new Date(obj.get('select', 'yyyy-mm-dd'));
    month = selectedDate.getMonth();
    year = selectedDate.getFullYear();
    periodTo.pickadate('picker')
        .set('min', [year, month, 1])
        .set('max', [year, month + 1, 0])
        .set('select', [year, month + 1, 0]);
    initField();
}
