function extracted() {
    var name = $(this).prop('name');
    value = getNumberFromString(name);
    var parentIndexNumber = value[0];
    var innerIndexNumber = value[1];
    var traineeElement = getTraineeDropdownElement(parentIndexNumber, innerIndexNumber);
    var nameElement = getGuestNameElement(parentIndexNumber, innerIndexNumber);
    var mobileNumberElement = getGuestMobileNumberElement(parentIndexNumber, innerIndexNumber);
    return {traineeElement, nameElement, mobileNumberElement};
}

$(document).on('ifChanged', '.trainee-checkbox', function () {
    removeBootstrapValidation();
    if ($(this).is(":checked")) {
        var {traineeElement, nameElement, mobileNumberElement} = extracted.call(this);
        toggleSelect2ElementVisibility(traineeElement, true);
        nameElement.val(null);
        toggleElementVisibility(nameElement, false);
        mobileNumberElement.val(null);
        toggleElementVisibility(mobileNumberElement, false);
    } else {
        var {traineeElement, nameElement, mobileNumberElement} = extracted.call(this);
        traineeElement.val(null);
        toggleSelect2ElementVisibility(traineeElement, false);
        toggleElementVisibility(nameElement, true);
        toggleElementVisibility(mobileNumberElement, true);
    }
});


function getTraineeDropdownElement(parentIndex, innerIndex) {
    return $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][trainees][]"]');
}

function getGuestNameElement(parentIndex, innerIndex) {
    return $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][name]"]');
}

function getGuestMobileNumberElement(parentIndex, innerIndex) {
    return $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][mobile_number]"]');
}

function getRoomTypeElement(parentIndex) {
    return $('[name="assign[' + parentIndex + '][room_type_id]"]');
}

function toggleElementVisibility(element, value) {
    $(element).prop("disabled", !value);
}

function toggleSelect2ElementVisibility(element, value) {
    if (value) {
        $(element).select2({disabled: false})
    } else {
        $(element).select2({disabled: true});
    }
}

function resetValidation(form) {
    removeBootstrapValidation();
    $(form).validate().resetForm();
}



