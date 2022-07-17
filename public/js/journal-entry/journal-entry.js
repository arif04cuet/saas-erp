function getEntryIndex(element) {
    if ($(element).attr("readonly")) {
        return;
    }
    let name = $(element).attr("name");
    let value = $(element).val();
    let index = getNumberFromString(name);
    toggleDebitCreditAmountField(index, value);
}

function getNumberFromString(name) {
    return name.replace(/[^0-9]/g, '');
}

function toggleDebitCreditAmountField(index, value) {
    let debitPattern = "journal_entries[" + index + "][debit_amount]";
    let creditPattern = "journal_entries[" + index + "][credit_amount]";
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
}


/**
 *
 * @param flag
 */
function makeSaveButtonToggle(flag) {
    let element = $('button[type="submit"]');
    element.attr('disabled', flag);
    let successClass = "btn-success";
    let disableClass = "btn-grey-blue";
    if (flag) {
        element.removeClass(successClass).addClass(disableClass);
    } else {
        element.removeClass(disableClass).addClass(successClass);
    }
}

function changeEmployeeDropdownVisibility(flag) {
    var element = $('.employee-dropdown');
    if (flag) {
        element.show();
    } else {
        element.hide();
    }
}


function getLastTableRow() {
    return $('table tr:last td select')[1]; // return the second select element which is transaction-type
}

function getLastTableHeader() {
    return $('table th:last')[0];
}


//  re-init all select2
function makeDropdownsSelect2() {
    $('.dropdown-select').select2({
        placeholder: 'select',
        selectOnClose: true,
    });
    // Account Dropdown
    $('.account-dropdown-select').select2({
        placeholder: 'select',
        selectOnClose: true,
    });
}

function InitAllDropDown() {
    $('.select2-container').remove();
    makeDropdownsSelect2();
}

function modifyLastSelectElement(indexNumber, val) {
    let element = $('[name="journal_entries[' + indexNumber + '][account_transaction_type]"]')[0];
    $(element).val(val);
    makeAllTransactionTypeDisable();
    makeAllDebitAccountDisable();
    makeAllCreditAccountDisable();
}

function makeAllTransactionTypeDisable() {
    $('.transaction-select')
        .attr('readonly', true)
        .css("pointer-events", "none");
}

function makeAllDebitAccountDisable() {
    $('.debit-amount')
        .attr('readonly', true)
}

function makeAllCreditAccountDisable() {
    $('.credit-amount')
        .attr('readonly', true)
}

function makeLastDescriptionDisable(indexNumber) {
    $('input[name="journal_entries[' + indexNumber + '][description]"]').val('Total Balance').attr("readonly", true);
}


function calculateBalance() {
    let debitValue = calculateDebitAmount();
    let creditValue = calcualateCreditAmount();
    let balance = debitValue - creditValue;
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
    $('input[name=balance]').val(value);
}

function getBalance() {
    let value = parseInt($('input[name=balance]').val());
    return value;
}

function makeRepeaterDeleteHidden() {
    $('table tr').each(function () {
        $(this).find('td:last').hide();
    });
}

function toggleCashBookEntryFlag(flag, indexNumber) {
    var element = $('[name="journal_entries[' + indexNumber + '][is_cash_book_entry]"]');
    if (flag) {
        element.val('1');
    } else {
        element.val('1');
    }
}
