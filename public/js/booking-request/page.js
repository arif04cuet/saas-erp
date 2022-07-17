function updateGuestCount(guestCount) {
    let guestCountInputSelector = 'input[name=no_of_guests]';
    $(guestCountInputSelector).data('guest-count', guestCount);
    $(guestCountInputSelector).val(guestCount);
}

$(document).ready(function () {
    initializeSelectReferee();

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

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

            $('.booking-request-tab-steps').append(`<input type="hidden" name="deleted-roominfos[]" value="${deletedId}">`);

            $(this).slideUp(deleteElement);
        }
    });

    $('.repeater-guest-information').repeater({
        // initEmpty: false,
        isFirstItemUndeletable: true,
        show: function () {
            // remove error span
            $('div:hidden[data-repeater-item]')
                .find('input.is-invalid, select.is-invalid, textarea.is-invalid')
                .each((index, element) => {
                    $(element).removeClass('is-invalid');
                });

            $(this).find('.select2-container').remove();
            $(this).find('select').select2({
                placeholder: selectPlaceholder
            });

            let guestCount = $('.repeater-guest-information').find('div[data-repeater-item]').length;
            updateGuestCount(guestCount);

            $(this).slideDown();
        },
        hide: function (deleteElement) {
            let guestCount = $('.repeater-guest-information').find('div[data-repeater-item]').length - 1;
            updateGuestCount(guestCount);

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
            return Date.parse(value) > Date.parse(comparingDate);
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

            validNumbers = validNumbers.map(function (number) {
                return parseInt(number);
            });

            return value.length === 0 ? true : validNumbers.includes(value.length);
        },
        'Nid should be equal to 10 or 13 or 17.'
    );

    $('.booking-request-tab-steps').validate({
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
                if (element.attr('name') === 'organization_purpose') {
                    error.insertBefore(element.parents().siblings('.radio-error-organization-purpose'));
                } else {

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
            contact: {
                minlength: 11,
                maxlength: 11
            },
            address: {
                maxlength: 300
            },
        },
    });

    $('input[type=radio][name=booking_type]').on('ifChecked', function (event) {
        if ($(this).val() == 'training') {
            $('.select-training-div').show();
        } else {
            $('select[name=training_id]').val(null).trigger('change');
            $('.select-training-div').hide();
        }
    });

    $('.training-select').on('change', function () {
        let trainingId = $(this).val();
        if (trainingId) {
            let $guestInfoRepeater = $('.repeater-guest-information').show();

            $.ajax({
                url: traineesUrl + '/' + trainingId,
                method: 'get',
                dataType: 'json'
            })
                .done(function (data) {
                    // remove form repeater inputs
                    $guestInfoRepeater.find('div[data-repeater-item]').remove();
                    // hide add more button
                    $guestInfoRepeater.find('button[data-repeater-create]').hide();
                    // render trainees table
                    $('.trainee-list').html(drawGuestListTableFromTrainees(data));
                    drawTableBodyForGuestInfosOfTrainees(data);
                })
                .fail(function () {
                    alert('Failed to get content from server');
                });
        }
    });

    try {
        if (typeof roomInfos != undefined) {
            dynamicallySelectRateForRooms(JSON.parse(roomInfos));
        }
    } catch (e) {
        console.debug(e)
    }

    //Dynamic Relation When New Guest Information Is Added
    $('#add_guest_info').on('click', function () {
        let isRequestOnBehalfSomeoneElse = $('input[name=is_own_request]').is(':checked');
        let removalValue = "myself";
        changeRelationField(isRequestOnBehalfSomeoneElse, removalValue);
    })
});

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

function getRateType(shortCode) {
    switch (shortCode) {
        case 'government_official':
            return governmentOfficial;
        case 'government_personal':
            return governmentPersonal;
        case 'non_government':
            return nonGovernment;
        case 'international':
            return international;
        case 'bard':
            return bard;
        case 'others':
            return others;
    }
}

function getRefereeInformation(employeeId) {
    if (!employeeId) {
        $('#bard-referee-div').hide();
        return;
    }

    let employee = employees.find(emp => emp.id == employeeId);
    let designation = designations.find(designation => designation.id == employee.designation_id);
    let department = departments.find(dept => dept.id == employee.department_id);

    $('#referee-name').html(employee.first_name + ' ' + employee.last_name);
    $('#referee-designation').html(designation.name);
    $('#referee-department').html(department.name);

    $('#bard-referee-div').show();
}

function dynamicallySelectRateForRooms(roomInfos) {
    $('.room-type-select').parents('.form.row').find('select.rate-select').each((index, selectElement) => {
        let roomInfo = roomInfos[index];
        let selectedRoomType = roomTypes.find(roomType => roomType.id == roomInfo.room_type_id);
        // create options of select
        $(selectElement).html(`<option value=""></option>
        <option value="ge_${selectedRoomType.general_rate}">GE ${selectedRoomType.general_rate}</option>
        <option value="govt_${selectedRoomType.govt_rate}">GOVT ${selectedRoomType.govt_rate}</option>
        <option value="bard-emp_${selectedRoomType.bard_emp_rate}">BARD EMP ${selectedRoomType.bard_emp_rate}</option>
        <option value="special_${selectedRoomType.special_rate}">Special ${selectedRoomType.special_rate}</option>`);
        // set value of select
        let roomRateValue = roomInfo.hasOwnProperty('rate_type') ? `${roomInfo.rate_type}_${roomInfo.rate}` : `${roomInfo.rate}`;
        $(selectElement).val(roomRateValue).trigger('change');
    });
}

function drawGuestListTableFromTrainees(trainees) {
    let tableRows = '';

    trainees.forEach((trainee, index) => {
        tableRows += `<tr>
        <input type="hidden" name="guests[${index}][first_name]" value="${trainee.bangla_name}"/>
        <input type="hidden" name="guests[${index}][middle_name]" value="${trainee.middle_name}"/>
        <input type="hidden" name="guests[${index}][last_name]" value="${trainee.trainee_last_name}"/>
        <input type="hidden" name="guests[${index}][gender]" value="${trainee.trainee_gender.toLowerCase()}"/>

        <input type="hidden" name="guests[${index}][age]" value="20"/>
        <input type="hidden" name="guests[${index}][nationality]" value="Bangladeshi"/>
        <input type="hidden" name="guests[${index}][relation]" value="trainee"/>
        <input type="hidden" name="guests[${index}][address]" value="Bangladesh"/>
        <td>${trainee.bangla_name}</td>
        <td>${trainee.trainee_last_name}</td>
        <td>${trainee.trainee_gender.toLowerCase() == 'male' ? male : female}</td>
        <td>${trainee.mobile}</td>
        </tr>`;
    });

    return `<table class="table table-bordered">
    <thead>
    <tr>
    <th>${firstNameLabel}</th>
    <th>${lastNameLabel}</th>
    <th>${genderLabel}</th>
    <th>${mobileLabel}</th>
    </tr>
    </thead>
    <tbody>
    ${tableRows}
    </tbody>
    </table>`;
}

function drawTableBodyForGuestInfosOfTrainees(trainees) {
    let tbody = '';

    trainees.forEach((trainee) => {
        tbody += `<tr>
            <td>${trainee.bangla_name}</td>
            <td>বাংলাদেশ</td>
            <td>${trainee.trainee_gender.toLowerCase() == 'male' ? male : female}</td>
            <td>শিক্ষানবিস</td>
            <td>বাংলাদেশ</td>
        </tr>`;
    });

    $('#guests-info-table').find('tbody').html(tbody);
}

function changeRelationField(flag, removalValue) {
    if (flag) {
        $('.relation-select').each(function () {
            $(this).find('[value=' + removalValue + ']').remove();
        });
    } else {
        $('.relation-select').not(':first').each(function () {
            $(this).find('[value=' + removalValue + ']').remove();
        });
    }
}
