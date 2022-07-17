/**
 * Created by Ashraful Islam
 * Email:  ashraful@orangebd.com
 */


/**
 * function to remove duplication from select type in repeater
 * @param className - class name of the select option
 * @param dropdownValues - key-value pair
 * @param isMultipleDropdown - flag for multiple dropdown
 * @param keepSelectOption - select label flag
 * @param placeholderValue
 */
function deleteDuplicateFromRepeater(
    className,
    dropdownValues,
    isMultipleDropdown = false,
    keepSelectOption = true,
    placeholderValue = 'Select an Option'
) {

    if (dropdownValues === undefined || dropdownValues.length === 0) {
        return;
    }
    var allSelectedValues = [];
    var difference = [];
    var allKeys = Object.keys(dropdownValues);
    //let placeholder = `{{trans('accounts::payroll.payslip_report.form_elements.searching')}}`;
    $(className).not(':last').each(function () {
        if (isMultipleDropdown) {
            $(this).find('option:selected').each(function () {
                allSelectedValues.push($(this).val());
            });
        } else {
            allSelectedValues.push($(this).val());
        }
    });
    //get the difference between the two array
    difference = allKeys.filter(x => !allSelectedValues.includes(x));
    // changing last select element
    lastSelectElement = $(className).last();
    lastSelectElement.empty();
    if (keepSelectOption) {
        lastSelectElement.append(
            '<option value="">' + placeholderValue + '</option>'
        )
    }

    difference.forEach(element => {
        lastSelectElement.append(
            '<option value="' + element + '">' + dropdownValues[element] + '</option>'
        )
    });
}

/**
 * returns all numbers from string
 * @param name
 * @returns {*}
 */
function getNumberFromString(name) {
    return name.replace(/[^0-9]/g, '');
}

/**
 * validate a form using this function
 */
function validateForm(classname) {
    removeBootstrapValidation();
    $(classname).validate({
        ignore: 'input[type=hidden],[readonly=readonly]',
        errorClass: 'danger',
        successClass: 'success',
        errorElement: "span",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
            $(element).parent('.form-group').addClass('error');
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
            $(element).parent('.form-group').removeClass('error');
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') === 'radio') {
                error.insertBefore(element.parents().siblings('.radio-error'));
            } else if (element[0].tagName === "SELECT") {
                //for normal dropdown
                error.insertAfter(element);
                //for select2 dropdown
                error.insertAfter(element.siblings('.select2-container'));
            } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {
                error.insertAfter(element);
            } else if (element.attr('type') === 'file') {
                error.insertAfter(element.parent().parent().find('.avatar-preview'));
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            // some common name and rules
            name: {
                maxlength: 50
            },
            mobile_number: {
                minlength: 11,
                maxlength: 11
            },
        },
        submitHandler: function (form, event) {
            if (confirm('Are you sure ?')) {
                form.submit();
            } else {
                return false;
            }
        }
    });
}

function removeBootstrapValidation() {
    $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');
}

/**
 * from a select element, this function checks if any options
 * are left for selection, if not shows an alert then return
 * @param className
 * @return boolean
 */
function isSelectOptionsEmpty(className) {
    var lastOptions = $(className).last().find('option');
    var totalLastoptions = lastOptions.filter(function () {
        return this.value; //  only keep the options with values
    }).length;
    if (!totalLastoptions) {
        alert('No options available');
        return false;
    }
    return true
}

function makeDropdownSelect2(className, placeHolder) {
    $(className).next('.select2-container').remove();
    $(className).select2({
        selectOnClose: true,
        placeholder: placeHolder
    });
}



