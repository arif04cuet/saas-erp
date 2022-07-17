$(document).ready(function () {

    // datepicker
    $('input[name=auction_date]').pickadate({
        min: new Date(),
        format: 'dd/mm/yyyy'
    });


    $('#add_scrap_product').click(function () {

        let allSelectedValues = [];
        let difference = [];

        $('.category-type-select').not(':last').each(function () {
            //this returns only the selected value
            let selectedValue = $(this).val();
            if (selectedValue)
                allSelectedValues.push(parseInt(selectedValue));
        });
        //get the difference between the two array
        difference = allValues.filter(x => !allSelectedValues.includes(x));
        lastSelectElement = $('.category-type-select').last();
        lastSelectElement.empty();
        if (difference === undefined || difference.length == 0) {
            lastSelectElement.append('<option value="null"> No More Item is Available </option>')
        } else {
            difference.forEach(element => {
                lastSelectElement.append('<option value="' + element + '">' + scrapProducts[element] + '</option>')
            });
        }

    });


    function print(value) {
        console.log(value);
    }

    $('.repeater-default').repeater({
        show: function () {
            $(this).slideUp();
        },
        isFirstItemUndeletable: true
    })


});