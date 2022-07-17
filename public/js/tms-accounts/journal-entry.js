function toggleDebitCreditAmountField(index, value) {
    let debitPattern = "tms_journal_entries[" + index + "][debit_amount]";
    let creditPattern = "tms_journal_entries[" + index + "][credit_amount]";
    let vatPattern = "tms_journal_entries[" + index + "][vat_amount]";
    let taxPattern = "tms_journal_entries[" + index + "][tax_amount]";
    if (value == 'receive') {
        // its receipt - credit
        toggleReadonlyProperty(creditPattern, false);
        toggleReadonlyProperty(debitPattern, true);
    } else if (value == 'payment') {
        // its payment - debit
        toggleReadonlyProperty(creditPattern, true);
        toggleReadonlyProperty(debitPattern, false);
    } else {
        toggleReadonlyProperty(creditPattern, true);
        toggleReadonlyProperty(debitPattern, true);
    }
    let vatElement = $('input[name="' + vatPattern + '"]');
    let taxElement = $('input[name="' + taxPattern + '"]');
    setElementValue(vatElement,0);
    setElementValue(taxElement,0);
}

function toggleReadonlyProperty(pattern, flag) {
    let element = $('input[name="' + pattern + '"]');
    $(element).attr("readonly", flag);
    setElementValue(element, 0);
}

function setElementValue(element, value) {
    $(element).val(value);
}

function getElement(element) {
    if ($(element).attr("readonly")) {
        return;
    }
    let name = $(element).attr("name");
    let value = $(element).val();
    let index = getNumberFromString(name);
    toggleDebitCreditAmountField(index, value);
    calculateBalance();
}


function calculateBalance() {
    let debitValue = calculateDebitAmount();
    let creditValue = calcualateCreditAmount();
    let vatAmount = calculateVatAmount();
    let taxAmount = calculateTaxAmount();
    let balance = creditValue - debitValue;
    setBalance(balance);
}

function calculateDebitAmount() {
    let debitValue = 0;
    $('.debit-amount').each(function () {
        let value = parseInt($(this).val());
        if (!isNaN(value))
            debitValue += value;
    });
    return debitValue;
}

function calculateTaxAmount() {
    let taxValue = 0;
    $('.tax-amount').each(function () {
        let value = parseInt($(this).val());
        if (!isNaN(value))
            taxValue += value;
    });
    return taxValue;
}

function calculateVatAmount() {
    let vatValue = 0;
    $('.vat-amount').each(function () {
        let value = parseInt($(this).val());
        if (!isNaN(value))
            vatValue += value;
    });
    return vatValue;
}

function calcualateCreditAmount() {
    let creditValue = 0;
    $('.credit-amount').each(function () {
        let value = parseInt($(this).val());
        if (!isNaN(value))
            creditValue += value;
    });
    return creditValue;
}

function setBalance(value) {
    //todo:: if value is negative, i have to pay, so credit it
    //todo:: if value is positive, i will receive cash , so debit it
    if (value < 0) {
        $('input[name="cash_book_entries[credit_amount]"]').val(Math.abs(value));
        $('input[name="cash_book_entries[debit_amount]"]').val(0);
        $('.cash-bank-transaction-type').val('payment');
    } else {
        $('input[name="cash_book_entries[debit_amount]"]').val(value);
        $('input[name="cash_book_entries[credit_amount]"]').val(0);
        $('.cash-bank-transaction-type').val('receive');
    }
}

function makeDropdownNotSelectable() {
    $('.cash-bank-transaction-type').css("pointer-events", "none");
}


function checkDebitAndCreditEquality() {
    let debitValue = calculateDebitAmount();
    debitValue += parseInt($('input[name="cash_book_entries[debit_amount]"]').val());
    creditValue += parseInt($('input[name="cash_book_entries[credit_amount]"]').val());
    let creditValue = calcualateCreditAmount();
    if (parseInt(debitValue) != parseInt(creditValue)) {
        alert('Debit and Credit Amount Should Match');
        return false;
    }
    return true;
}

function initAllRepeater(className) {
    $(className).repeater({
        initEmpty: false,
        show: function () {
            makeDropdownSelect2('.select2', placeholder);
            let trainingElement = $('.training-select');
            if (!trainingElement.val()) {
                return;
            }
            let codeSelectElement = $('.sub-sector-select')
                .not((index, element) => {
                        if ($(element).val())
                            return true;
                        else
                            return false
                    }
                );
            filterTmsSubSectorCodesByTraining(getBudgetKeys($('.training-select')), codeSelectElement);
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                //calculate again after a second
                setTimeout(function () {
                    calculateBalance();
                }, 1000);
            }
        },
        defaultValues: {
            debit_amount: 0,
            credit_amount: 0,
            is_cash_book_entry: '0',
        },
        isFirstItemUndeletable: true,
    });
}

/**
 * get all the related budget keys for a training
 * @param obj
 * @return {string[]}
 */
function getBudgetKeys(obj) {
    let value = $(obj).val();
    budgetMaxValues = allBudgetMaxValues[value];
    let keys = Object.keys(budgetMaxValues);
    return keys;
}

/**
 * This is triggered when a training is changed
 * @param obj
 */
function getMaxValues(obj) {
    let keys = getBudgetKeys(obj);
    filterTmsSubSectorCodesByTraining(keys, $('.sub-sector-select'));
}

function filterTmsSubSectorCodesByTraining(keys, codeSelectElement) {
    let allKeys = Object.keys(tmsSubSectors);
    let difference = allKeys.filter(x => keys.includes(x));
    codeSelectElement.empty();
    codeSelectElement.append(
        '<option value="">' + placeholder + '</option>'
    )
    difference.forEach(element => {
        codeSelectElement.append(
            '<option value="' + element + '">' + tmsSubSectors[element] + '</option>'
        )
    });
}

function changeElementVisibility(className, flag) {
    let element = $(className);
    if (flag) {
        element.show();
    } else {
        element.hide();
    }
}

function toggleRequiredAttribute(className, flag) {
    let element = $(className);
    if (flag) {
        element.addClass("required");
    } else {
        element.removeClass("required");
    }
}


function adjustVatAndTaxAmount(element) {
    let name = $(element).attr("name");
    let amount = parseFloat($(element).val());
    let index = getNumberFromString(name);
    // select that transaction select , read its value m then select debit or credit value
    let transactionSelectPattern = "tms_journal_entries[" + index + "][transaction_type]";
    let debitPattern = "tms_journal_entries[" + index + "][debit_amount]";
    let creditPattern = "tms_journal_entries[" + index + "][credit_amount]";
    let transactionSelectElement = $('select[name="' + transactionSelectPattern + '"]');
    let creditElement = $('input[name="' + creditPattern + '"]');
    let debitElement = $('input[name="' + debitPattern + '"]');
    let value = transactionSelectElement.val();

    if (value == 'receive') {
        // its receive - credit - read the credit value
        let creditValue = parseFloat(creditElement.val());
        creditElement.val(creditValue + amount);
    } else {
        // its payment - debit - read the debit value
        let debitValue = parseFloat(debitElement.val());
        debitElement.val(debitValue + amount);
    }
    calculateBalance();
}









