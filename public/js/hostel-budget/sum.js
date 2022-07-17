function calculateBudgetSum(inputSelector) {
    $(".budgetCreateForm").on("change, keyup", `input[name*='${inputSelector}']`, function(e){
        var sum = 0;
        $(`input[name*='${inputSelector}']`).each(function(i, e){
            var value= $(this).val() === ""? 0: parseInt($(this).val());
            sum+=value;		
        });  
        console.log(sum);
        $('#total_budget_amount').html(sum);
    });
}