function reIndexErrorLabels() {
    let repeaterKey = Object.keys($(this).repeaterVal()).shift();

    $(`label[id*=${repeaterKey}][class=danger]`).each((index, element) => {
        let regex = /\[[0-9]+\]/;

        let newIdString = element.getAttribute('id').replace(regex, `[${index}]`);
        let newForString = element.getAttribute('for').replace(regex, `[${index}]`);

        element.setAttribute('id', newIdString);
        element.setAttribute('for', newForString);
    });
}

$(document).ready(function () {
    let repeater = $('.repeater-custom').repeater({
        show: function () {
            $(this).find('.danger').remove();

            reIndexErrorLabels.call(this);

            $(this).slideDown();
        },
    });
});
