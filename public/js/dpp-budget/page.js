$(document).ready(function () {

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

    toggleComponents(($('.section-type-select').val() === "price_contingency" || $('.section-type-select').val() === "physical_contingency"));
    calculateTotalExpense();

    $('.economy-code-select, .section-type-select').select2({
        placeholder: selectPlaceholder
    });

    $('input[name=unit_rate], input[name=quantity]').keyup(() => {
        calculateTotalExpense();
    });

    $('.section-type-select').change(function (e) {
        toggleComponents((e.target.value === "price_contingency" || e.target.value === "physical_contingency"));
    });

    $('input[name=total_expense_percentage]').keyup(() => {
        calculatePercentageOfTotalExpense();
    });

});

jQuery.validator.addMethod(
    "checksum",
    function (value, element, params) {
        let sum = 0;
        params.forEach(function (el) {
            sum += parseFloat($(el).val());
        });
        return parseFloat(value) === sum;
    },
    checksumMessage
);

jQuery.validator.addMethod(
    "checkFiscalSum",
    function (value, element, params) {
        let total = parseFloat(value);
        let sum = 0;

        $(params).find('tr').each(function (index, value) {
            let monetaryAmount = parseFloat($(this).find('input[name^=monetary_amount]').val());
            let monetaryPercentage = parseFloat($(this).find('input[name^=monetary_percentage]').val());

            if(Number.isNaN(monetaryAmount) && Number.isNaN(monetaryPercentage)){
                return true;
            } else if (Number.isNaN(monetaryAmount)){
                sum += (total*(monetaryPercentage/100));
            } else if (Number.isNaN(monetaryPercentage)){
                sum += (monetaryAmount * 100000);
            }
        });

        return total === sum;
    },
    checksumMessage
);

jQuery.validator.addMethod(
    "isGiven",
    function (value, element, params) {
        let tds = $(element).parent().parent().find('input');
        let monetaryAmount = 0;
        let monetaryPercentage = 0;

        tds.each(function (i, el) {
            if (i === 1 )
                monetaryAmount = parseFloat($(el).val());
            else if (i === 2)
                monetaryPercentage = parseFloat($(el).val());
        });

        return (value) ? true : !(!Number.isNaN(monetaryAmount) || !Number.isNaN(monetaryPercentage));
    },
    fieldRequired
);

let validator = $('.project-budget-form').validate({
    ignore: [],
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
            error.insertBefore(element.parents().siblings('.radio-error'));
        } else if (element[0].tagName == "SELECT") {
            error.insertAfter(element.siblings('.select2-container'));
        } else if (element.attr('id') == 'ckeditor') {
            error.insertAfter(element.siblings('#cke_ckeditor'));
        } else {
            error.insertAfter(element);
        }
    },
    rules: {
        check_distributed_collection: {
            checksum: ['input[name=gov_source]', 'input[name=own_financing_source]', 'input[name=other_source]']
        },
        check_distributed_fiscalyear: {
            checkFiscalSum: '#fiscal-list',
        },
        'fiscal_year[0]': { isGiven: true },
        'fiscal_year[1]': { isGiven: true },
        'fiscal_year[2]': { isGiven: true },
        'fiscal_year[3]': { isGiven: true },
        'fiscal_year[4]': { isGiven: true },
    },
    submitHandler: function (form, event) {
        $(form).find('input[name=check_distributed_collection]').remove();
        $(form).find('input[name=check_distributed_fiscalyear]').remove();
        form.submit();
    }
});

function toggleComponents(bool) {

    let components = $(`select[name=economy_code_id], input[name=unit], input[name=unit_rate], input[name=quantity]`);

    components.prop( "disabled", bool);

    //$('input[name=total_expense]').prop("readonly", bool);
    $('input[name=total_expense_percentage]').prop( "disabled", !bool);
    $('.toggle-content-text').toggle(bool);
    $('.toggle-content-form').toggle(!bool);

    if (bool) {
        components.removeAttr('required');

        $.get(
            totalExpenseUrl,
            function (budget) {
                $('.total-capital-revenue').text(budget.totalExpense);
                calculatePercentageOfTotalExpense();
            }
        );

    } else {
        components.attr('required', 'required');
    }

    validator.resetForm();
}

function calculateTotalExpense() {

    var unitRate = $('input[name=unit_rate]').val();
    var quantity = $('input[name=quantity]').val();

    var totalExpense = Number(unitRate) * Number(quantity);

    $('input[name=total_expense], input[name=check_distributed_collection], input[name=check_distributed_fiscalyear]')
        .val(totalExpense);
}

function calculatePercentageOfTotalExpense() {

    var totalExpense = Number($('.total-capital-revenue').text());
    var percentage = $('input[name=total_expense_percentage]').val();

    var total = (totalExpense * percentage) / 100;

    $('.total-expense-based-percentage').text(total);
    $('input[name=check_distributed_collection], input[name=check_distributed_fiscalyear]')
        .val(total);
}