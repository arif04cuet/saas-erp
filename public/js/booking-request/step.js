function setRequesterAsGuest() {
    let firstName = $('input[name=first_name]').val();
    let middleName = $('input[name=middle_name]').val();
    let lastName = $('input[name=last_name]').val();
    let address = $('textarea[name=address]').val();
    let gender = $('input[type=radio][name=gender]:checked').val();
    let nid = $('input[name=nid]').val();

    $('input[name="guests[0][first_name]"]').val(firstName);
    $('input[name="guests[0][middle_name]"]').val(middleName);
    $('input[name="guests[0][last_name]"]').val(lastName);
    $('input[name="guests[0][nid_no]"]').val(nid);
    $('textarea[name="guests[0][address]"]').val(address);
    $('select[name="guests[0][gender]"]').val(gender).trigger('change');
}

function renderRoomInfos() {
    let roomInfos = $('.repeater-room-infos').repeaterVal().roomInfos;
    let startTime = new Date($('#start_date').val());
    let endTime = new Date($('#end_date').val());
    let daysCount = Math.ceil(Math.abs(endTime.getTime() - startTime.getTime()) / (1000 * 60 * 60 * 24));

    let selectedOrgType = $('input[type=radio][name=organization_type]').filter(':checked').val();

    if (selectedOrgType === "government") {
        selectedOrgType += "_" + $('input[type=radio][name=organization_purpose]').filter(':checked').val();
    }

    let roomInfoRows = roomInfos.map(roomInfo => {
        let roomTypeRate = getRoomTypeRate(roomInfo.room_type_id, selectedOrgType),
            roomQuantity = roomInfo.quantity,
            vatTaxPercentage = Number.parseFloat((roomTypeRate * roomQuantity * daysCount * 20.00) / 100.00).toFixed(2);

        return `<tr>
        <td>${roomTypes.find(roomType => roomType.id == roomInfo.room_type_id).name}</td>
        <td>${roomInfo.quantity || 0}</td>
        <td>${$('#start_date').val() + ' To ' + $('#end_date').val()}</td>
        <td>${getRateType(selectedOrgType)}</td>
        <td>${roomTypeRate} x ${roomInfo.quantity} x ${daysCount}</td>
        <td>${vatTaxPercentage}</td>
        <td>${Number.parseFloat(Number.parseFloat(roomTypeRate * roomQuantity * daysCount) + Number.parseFloat(vatTaxPercentage)).toFixed(2)}</td>
        </tr>`;
    });

    $('#billing-table').find('tbody').html(roomInfoRows);
}

function renderRequesterInfo() {
    $('#primary-contact-name').html($('input[name=first_name]').val() + ' ' + $('input[name=middle_name]').val()
        + ' ' + $('input[name=last_name]').val());
    $('#primary-contact-contact').html($('#primary-contact-contact-input').val());
    $('#start_date_display').html($('#start_date').val());
    $('#end_date_display').html($('#end_date').val());
}

function renderGuestInfos() {
    let guestInfos = $('.repeater-guest-information').repeaterVal().guests;
    let guestInfoRows = guestInfos.map(guestInfo => {
        console.log(guestInfo);
        return `<tr>
        <td>${guestInfo.first_name} ${guestInfo.middle_name} ${guestInfo.last_name}</td>
        <td>${guestInfo.nationality}</td>
        <td>${guestInfo.gender == 'male' ? male : female}</td>
        <td>${guestRelations[guestInfo.relation]}</td>
        <td>${guestInfo.address}</td>
        </tr>`;
    });
    console.log(guestInfoRows);
    $('#guests-info-table').find('tbody').html(guestInfoRows);
}

function renderReferenceInfo() {
    $('#bard-referee-name').html($('#referee-name').text());
    $('#bard-referee-designation').html($('#referee-designation').text());
    $('#bard-referee-department').html($('#referee-department').text());
}

function getRoomTypeRate(roomTypeId, organizationType) {
    let roomType = roomTypes.find(roomType => roomType.id == roomTypeId);
    let rate = roomType[organizationType + '_rate'];
    let capacity = roomType['capacity'];
    if ('seat_wise_calculation' in roomType) {
        if (roomType['seat_wise_calculation']) {
            rate = Number.parseFloat(rate / capacity).toFixed(2)
        }
    }
    return Number.parseFloat(rate).toFixed(2);
}

function generateDefaultOptions(container, defaultKeys = ['family', 'friend', 'coworker']) {

    let result = '<option selected></option>';

    Object.keys(guestRelations).forEach(function (key, index) {

        if (defaultKeys.includes(key)) {
            result += '<option value="' + key + '">' + guestRelations[key] + '</option>';
        }
    });

    container.html(result);
}

var form = $('.booking-request-tab-steps').show();

// jquery steps
$('.booking-request-tab-steps').steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: labels,
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        if (newIndex == 1) {
            if ($('.repeater-room-infos').has('div[data-repeater-item]').length == 0) {
                alert('Please select room details');
                return false;
            }

            let organizationPurposeContainer = $('.organization-purpose-container'),
                organizationType = $('input[type=radio][name=organization_type]'),
                selectedOrganizationType = organizationType.filter(':checked').val();

            if (selectedOrganizationType === undefined || selectedOrganizationType !== "government") {
                organizationPurposeContainer.find('input[type=radio][name=organization_purpose]').attr('disabled', true);
                organizationPurposeContainer.slideUp();
            }

            organizationType.on("ifChecked", function (e) {
                if ($(this).val() === "government") {
                    organizationPurposeContainer.find('input[type=radio][name=organization_purpose]').attr('disabled', false);
                    organizationPurposeContainer.slideDown();
                } else {
                    organizationPurposeContainer.find('input[type=radio][name=organization_purpose]').attr('disabled', false);
                    organizationPurposeContainer.slideUp();
                }
            });

            if (pageType == 'checkin') {

                // added by sumon mahmud
                // capturing data from matrix
                var selectedRoomTypeNumberFromMatrix = [];
                var allSelectedRoom = [];
                $('.ck-rooms:checked').map(function () {
                    allSelectedRoom.push($(this).data('roomType'));
                    return this.value;
                });

                // making array of same type counter value
                allSelectedRoom.forEach(function (i) {
                    selectedRoomTypeNumberFromMatrix[i] = (selectedRoomTypeNumberFromMatrix[i] || 0) + 1;
                });
                // counting the total number of room taken from matrix
                var totalSelectedRoomFromMatrix = 0;
                for (var i in selectedRoomTypeNumberFromMatrix) {
                    totalSelectedRoomFromMatrix += selectedRoomTypeNumberFromMatrix[i];
                }

                var collectingDataFromRepeatForm = $('.repeater-room-infos').repeaterVal('roomInfos').roomInfos.reduce(function (groups, item) {
                    var val = item['room_type_id'];
                    groups[val] = groups[val] || [];
                    groups[val].push(item);
                    return groups;
                }, []).filter(el => {
                    return el;
                })
                // console.log(x);

                var roomInfoFromInput = [];

                for (i = 0; i < collectingDataFromRepeatForm.length; i++) {
                    collection = collectingDataFromRepeatForm[i];
                    for (j = 0; j < collection.length; j++) {
                        if (typeof roomInfoFromInput[i] == "undefined") {
                            roomInfoFromInput[i] = collection[j]
                        } else {
                            totalRoom = Number(collection[j]['quantity']) + Number(roomInfoFromInput[i]['quantity']);
                            roomInfoFromInput[i]['quantity'] = totalRoom;
                        }
                    }
                }

                // counting the total number of room taken from input
                var totalRoomSelectedFromInput = 0;
                for (i = 0; i < roomInfoFromInput.length; i++) {
                    totalRoomSelectedFromInput += Number(roomInfoFromInput[i]['quantity']);
                }

                // Checking validation
                var validationStatus = false;
                if (totalRoomSelectedFromInput > totalSelectedRoomFromMatrix) {
                    $('#validationError').html(minimum_message + " " + totalRoomSelectedFromInput + " " + room);
                    $('#validationError').show();
                } else if (totalRoomSelectedFromInput < totalSelectedRoomFromMatrix) {
                    $('#validationError').html(maximum_message + " " + totalRoomSelectedFromInput + " " + room);
                    $('#validationError').show();
                } else {

                    for (i = 0; i < roomInfoFromInput.length; i++) {
                        var singleRoom = roomInfoFromInput[i];
                        roomTypeIdFromForm = singleRoom['room_type_id'];
                        roomQuantity = Number(singleRoom['quantity']);

                        if (roomTypeIdFromForm in selectedRoomTypeNumberFromMatrix) {
                            roomCountFromMatrix = Number(selectedRoomTypeNumberFromMatrix[roomTypeIdFromForm]);

                            if (roomQuantity < roomCountFromMatrix) {
                                if (current_lang == 'bn') {
                                    var message = maximum + " " + roomQuantity + " " + the + " " + room_type_names[roomTypeIdFromForm] + " " + room_selection;
                                } else {
                                    var message = at_most + " " + roomQuantity + " " + room_type_names[roomTypeIdFromForm] + room;
                                }
                                $('#validationError').html(message);
                                $('#validationError').show();
                                return;
                            } else if (roomQuantity > roomCountFromMatrix) {
                                if (current_lang == 'bn') {
                                    var message = minimum + " " + roomQuantity + " " + the + " " + room_type_names[roomTypeIdFromForm] + " " + room_selection;
                                } else {
                                    var message = at_least + " " + roomQuantity + " " + room_type_names[roomTypeIdFromForm] + room;
                                }
                                $('#validationError').html(message);
                                $('#validationError').show();
                                return;
                            } else {
                                validationStatus = true;
                            }
                        } else {
                            $('#validationError').html(wrong_selection + " ! ");
                            $('#validationError').show();
                            return;
                        }
                    }
                }
                if (!validationStatus) {
                    return false;
                    $('#validationError').show();
                } else {
                    $('#validationError').hide();
                }
                // end araf
            }
        }
        if (newIndex == 2) {
            let isRequestOnBehalfSomeoneElse = $('input[name=is_own_request]').is(':checked');
            if (!isRequestOnBehalfSomeoneElse) {
                setRequesterAsGuest();
            }

            /*
           |--------------------------------------------------------------------------
           |                     Remove "Myself" Option
           |--------------------------------------------------------------------------
           |if Requesting on behalf-> remove myself from all dropdown
           |else, fix myself in one dropdown, removes from the other
           |
           */
            let removalValue = "myself",
                relationDropDownContainer = $('.relation-select');


            if (isRequestOnBehalfSomeoneElse) {

                relationDropDownContainer.each(function () {
                    $(this).find('[value=' + removalValue + ']').remove();
                });

                let firstDropdown = relationDropDownContainer.first();

                if (firstDropdown.find('option').length === 0) {
                    generateDefaultOptions(firstDropdown);
                }

            } else {
                relationDropDownContainer.not(':first').each(function () {
                    $(this).find('[value=' + removalValue + ']').remove();
                });

                let firstDropdown = relationDropDownContainer.first();

                if (firstDropdown.find('option[value=' + removalValue + ']').length === 0) {
                    generateDefaultOptions(firstDropdown, [removalValue]);
                }

                firstDropdown.val(removalValue).find('option').not(':selected')
                    .remove().select2().trigger('change');

            }

        }
        if (newIndex == 3) {
            // render summary
            renderRoomInfos();

            renderRequesterInfo();

            let hasGuestInfo = $('.repeater-guest-information').has('div[data-repeater-item]').length >= 1;
            if (hasGuestInfo) {
                $('.guests-info-div').show();
                renderGuestInfos();
            } else {
                $('.guests-info-div').show();
            }
            let isReferencePresent = $('#referee-select').val();
            if (isReferencePresent) {
                $('.bard-referee-summary-div').show();
                renderReferenceInfo();
            } else {
                $('.bard-referee-summary-div').hide();
            }
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        $('.booking-request-tab-steps').submit();
    }
});
