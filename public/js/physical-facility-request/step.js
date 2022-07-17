var form = $(formContainer).show();

// jquery steps
$(formContainer).steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: labels,
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        console.log(currentIndex + ', ' + newIndex);
        if (currentIndex > newIndex) {
            return true;
        }
        //alert('please provide the name');
        if (newIndex == 1) {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            let name = $('#requester_name').val(),
                mobileNo = $('#mobile_no').val(),
                organizationName = $('#organization-name').val(),
                hostel = $('#hostel').is(':checked'),
                cafeteria = $('#cafeteria').is(':checked'),
                validMobile = isValidMobileNumber(mobileNo);

            if (hostel == true || cafeteria == true){
                console.log('working');
            } else {
                $(".check-error").html(requiredMessage);
                return false;
            }

            if ( name == '' || mobileNo == '' || organizationName == '' || !validMobile )
            {
                if (name == '') {
                    $("#name-error").html(requiredMessage);
                }
                if (mobileNo == '') {
                    $("#mobile-error").html(requiredMessage);
                }
                if (organizationName == '') {
                    $("#organization-error").html(requiredMessage);
                } else if (!validMobile) {
                    $("#mobile-error").html(invalidMobileMessage);
                }
                console.log('validation failed');
                return false;
            }else {
                console.log('validation passed');
                return true;
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

        let isChecked = $(this).is(":checked");
        const element = $('.checkRequest');
        if(!isChecked) {
            element.each(function() {
                $(this).is(":checked")? isChecked = true : '';
            });
        }
        element.prop('required', !isChecked);

    },
    onFinished: function (event, currentIndex) {
        $(formContainer).submit();
    }
});
