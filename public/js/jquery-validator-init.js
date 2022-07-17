$(document).ready(function () {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
    $('form').not('#logout-form').validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'danger',
        successClass: 'success',
    });
});