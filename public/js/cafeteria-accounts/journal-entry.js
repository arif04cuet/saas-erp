function toggleDebitCreditAmountField(index, value) {
    let debitPattern = "cafeteria_journal_entries[" + index + "][debit_amount]";
    let creditPattern = "cafeteria_journal_entries[" + index + "][credit_amount]";
    if (value == 'receipt') {
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
}

function toggleReadonlyProperty(pattern, flag) {
    let element = $('input[name="' + pattern + '"]');
    $(element).attr("readonly", flag);
    $(element).val(0);
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
        $('.cash-bank-transaction-type').val('receipt');
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








