$(document).ready(function () {
    initializeSelectReferee();

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

    // datepicker
    $('#start_date').pickadate({
        min: new Date()
    });

    $('#end_date').pickadate({
        min: +1,
    });

    $('#start_date, #end_date').pickadate();

    // form-repeater
    $('.repeater-room-infos').repeater({
        show: function () {
            $(this).find('.select2-container').remove();
            $(this).find('select').select2({
                placeholder: selectPlaceholder
            });

            // remove error span
            $('div:hidden[data-repeater-item]')
                .find('input.is-invalid, select.is-invalid')
                .each((index, element) => {
                    $(element).removeClass('is-invalid');
                });

            $(this).slideDown();
        },


        hide: function (deleteElement) {

            let deletedId = $(this).find('input[type=hidden]').val();

            $(formContainer).append(`<input type="hidden" name="deleted-roominfos[]" value="${deletedId}">`);

            $(this).slideUp(deleteElement);
        }
    });


    // select2
    $('.training-select, .room-type-select, .rate-select, .guest-gender-select, #department-select, .relation-select')
        .select2({
            placeholder: selectPlaceholder
        });

    // validation
    jQuery.validator.addMethod(
        "greaterThanOrEqual",
        function (value, element, params) {
            let comparingDate = params == '#start_date' ? $(params).val() : params;
            return Date.parse(value) >= Date.parse(comparingDate);
        },
        dateErrorMsg
    );

    jQuery.validator.addMethod(
        "regex",
        function (value, element, params) {
            let regex = new RegExp(params);
            return value.match(params);
        },
        'Letters only.'
    );

    jQuery.validator.addMethod(
        "nid-validation-count",
        function (value, element, params) {

            let validNumbers = params.split(",");

            validNumbers = validNumbers.map(function(number) {
                return parseInt(number);
            });

            return value.length === 0 ? true : validNumbers.includes(value.length);
        },
        'Nid should be equal to 10 or 13 or 17.'
    );

    $(formContainer).validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'danger',
        successClass: 'success',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') == 'radio') {
                if(element.attr('name') === 'organization_purpose') {
                    error.insertBefore(element.parents().siblings('.radio-error-organization-purpose'));
                }else {

                    error.insertBefore(element.parents().siblings('.radio-error'));
                }

            } else if (element[0].tagName == "SELECT") {
                error.insertAfter(element.siblings('.select2-container'));
            } else if (element.attr('id') == 'start_date' || element.attr('id') == 'end_date') {
                error.insertAfter(element.parents('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            end_date: {
                greaterThanOrEqual: '#start_date'
            },
            first_name: {
                maxlength: 50
            },
            address: {
                maxlength: 300
            },
        },
    });

});

function isValidMobileNumber(mobile) {
     return (mobile.length == 11 && !isNaN(mobile.substr(1)));
}

function initializeSelectReferee() {
    let $selectReferee = $('#referee-select').select2();

    let bookingRequestRefereeId = $selectReferee.val();

    if (bookingRequestRefereeId) {
        $selectReferee.val(bookingRequestRefereeId).trigger('change');
    }
}

function getRoomTypeRates(event, roomTypeId) {
    let selectedRoomType = roomTypes.find(roomType => roomType.id == roomTypeId);

    $(event.target).parents('.form.row').find('select.rate-select').html(`<option value=""></option>
    <option value="ge_${selectedRoomType.general_rate}">GE ${selectedRoomType.general_rate}</option>
    <option value="govt_${selectedRoomType.govt_rate}">GOVT ${selectedRoomType.govt_rate}</option>
    <option value="bard-emp_${selectedRoomType.bard_emp_rate}">BARD EMP ${selectedRoomType.bard_emp_rate}</option>
    <option value="special_${selectedRoomType.special_rate}">Special ${selectedRoomType.special_rate}</option>`);
}
