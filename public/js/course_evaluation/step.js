let courseEvaluationFormContainer = '.course-evaluation-tab-steps';
var form = $(courseEvaluationFormContainer).show();

// jquery steps
$(courseEvaluationFormContainer).steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: labels,
    onStepChanging: function (event, currentIndex, newIndex) {
        console.log(currentIndex);
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        // console.log(form)
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {


        if (form.valid()) {
            // const data = getFormData(form)
            // console.log(data);
            // console.log('form submitting!');
            $('.course-evaluation-tab-steps').submit();
            // form.find('div.actions').find('a[href=#finish]').attr('disabled', true).off('click');
        }
        // $('.booking-request-tab-steps').submit();
    }
});

function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}
