// this file has the common codes for
// newly designed check-in feature
// these functions are called from the repeater callback
// used in : approved-training/checkin, approved-physical-facility/checkin

$(document).on('change', '.room-type-select', function () {
    modifyRoomSelectionView($(this));
    // if some rooms already selected , remove them and validate
    name = $(this).prop('name');
    rooms = getRoomElementsOfRoomTypes(getNumberFromString(name)[0]);
    values = [];
    rooms.each(function () {
        val = $(this).val().trim();
        if (!val == '') {
            values.push(val);
        }
        $(this).val('');
    });
    if (values.length) {
        getFormElement().valid();
    }
});


function getRoomElementsOfRoomTypes(indexNumber) {
    elements = $('input[name^="assign[' + indexNumber + '][room]"]').filter(function () {
        if ($(this).hasClass('rooms')) return true;
    });
    return elements;
}

function makeAllDropdownSelect2(className) {
    $('.select2-container').remove();
    $(className).select2({
        selectOnClose: true,
        allowClear: true
    });
}


function modifyRoomSelectionView(obj) {
    showAllRoomSelection();
    var roomTypeId = obj.val();
    $('.ck-rooms').each(function (index, obj) {
        var room = $(obj);
        if (room.data('room-type') != roomTypeId) {
            room.hide();
            room.parent().css("background-color", "#878896");
        }
    });
}

function hideAlreadyCheckedRooms() {
    $('.ck-rooms').each(function (index, obj) {
        var room = $(obj);
        if (room.is(':checked')) {
            room.parent().hide();
        }
    });
}

function validateSingleElement(element) {
    form = getFormElement();
    resetValidation(form);
    $(form).validate().element(element);
}

/**
 * Called from 'onclick'
 * @param obj
 */
function showModal(obj) {

    // if room-type is not selected show an alert and return
    name = $(obj).prop('name');
    parentIndex = getNumberFromString(name)[0];
    roomTypeElement = getRoomTypeElement(parentIndex)
    if (!roomTypeElement.val()) {
        validateSingleElement(roomTypeElement);
        return;
    }
    setModalTriggerName(name);
    $('#selectionModal').modal("show");
}

function showAllRoomSelection() {
    $('.ck-rooms').each(function (index, obj) {
        $(obj).show();

        if ($(obj).parent().data('status') === 'partially_available') {
            $(obj).parent().css("background-color", "#ffd162");
        } else if ($(obj).parent().data('status') === 'unavailable') {
            $(obj).parent().css("background-color", "red");
        } else {
            $(obj).parent().css("background-color", "green");
        }
    });
}

function setModalTriggerName(name) {
    window.triggerId = name;
}

function getModalTriggerName() {
    return window.triggerId;
}

function reInitIcheckBox() {
    $(".trainee-checkbox").iCheck({
        checkboxClass: 'icheckbox_flat-green',
    });
}

function getFormElement() {
    return $('form').not('#logout-form');
}




