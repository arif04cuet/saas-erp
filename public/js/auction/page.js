$(document).ready(function () {

    // datepicker
    $('input[name=auction_date]').pickadate({
        min: new Date(),
        format: 'dd/mm/yyyy'
    });

    $('#add_scrap_product').click(function(){

        console.log(scrapProducts);

        let allSelectedValues=[];
        let difference=[];

        $('.category-type-select').not(':last').each(function(){
            //this returns only the selected value
            let selectedValue = $(this).val();
            if(selectedValue)
                allSelectedValues.push(parseInt(selectedValue));
        });
        //get the difference between the two array
        difference = allValues.filter(x => !allSelectedValues.includes(x));

        let lastSelectElement = $('.category-type-select').last();
        lastSelectElement.empty();

        difference.forEach(element => {
            lastSelectElement.append('<option value="'+element+'">'+scrapProducts[element]+'</option>')
        });
    });


    
});