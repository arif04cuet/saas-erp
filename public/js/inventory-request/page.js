$(document).ready(function () {

    let isInitiated = false;

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");


    let categoryRepeater = $(`.repeater-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {

            if ($('.item-category-select').length !== 0 && isInitiated === true) {

                dropdownSync('.item-category-select', inventoryItems, allItemsValues);

                removeItemFromDropdownAfterInitialization({
                    '.item-category-select': selectedItemCategories(
                        '.item-category-select'
                    )
                });

            }

            initiateTasks(this);

        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {

                $(this).slideUp(deleteElement);

                addItemToOtherDropdownAfterDelete(
                    {
                        '.item-category-select': selectedItemCategories(
                            '.item-category-select',
                            $(this)
                        )
                    },
                    inventoryItems,
                    allItemsValues,
                    $(this)
                );
            }
        }
    });

    if (activeItemsOfThisRequest.length) {
        categoryRepeater.setList(activeItemsOfThisRequest);

    }

    let boughtCategoryRepeater = $(`.repeater-bought-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {
            if ($('.bought-category-select').length !== 0 && isInitiated === true) {
                dropdownSync('.bought-category-select', inventoryBoughtItems, allBoughtItemsValues);

                removeItemFromDropdownAfterInitialization({
                    '.bought-category-select': selectedItemCategories(
                        '.bought-category-select'
                    )
                });
            }
            initiateTasks(this);
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);

                addItemToOtherDropdownAfterDelete(
                    {
                        '.bought-category-select': selectedItemCategories(
                            '.bought-category-select',
                            $(this)
                        )
                    },
                    inventoryBoughtItems,
                    allBoughtItemsValues,
                    $(this)
                );
            }
        }
    });

    if (inactiveItemsOfThisRequest.length) {
        boughtCategoryRepeater.setList(inactiveItemsOfThisRequest);
    }

    $(`.repeater-new-category-request`).repeater({
        // isFirstItemUndeletable: true,
        initEmpty: true,
        show: function () {
            initiateTasks(this);
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    isInitiated = true;

    removeItemFromDropdownAfterInitialization(
        {
            '.item-category-select': activeItemsOfThisRequest,
            '.bought-category-select': inactiveItemsOfThisRequest
        }
    )
});


let validator = $('.inventory-request-form').validate({
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
    rules: {},
    submitHandler: function (form, event) {
        form.submit();
    }
});

function dropdownSync(element, allItems, allValues) {

    let allSelectedValues = [];
    let difference = [];

    $(element).not(':last').each(function (e) {
        //this returns only the selected value
        let selectedValue = $(this).val();
        if (selectedValue)
            allSelectedValues.push(parseInt(selectedValue));
    });

    //get the difference between the two array
    difference = allValues.filter(x => !allSelectedValues.includes(x));

    let lastSelectElement = $(element).last();
    lastSelectElement.empty();

    difference.forEach(element => {
        lastSelectElement.append('<option value="' + element + '">' + allItems[element] + '</option>')
    });
}

function initiateTasks(instance) {
    $(instance).slideDown();
}

function removeItemFromDropdownAfterInitialization(elementsItemsMap) {

    for (var key in elementsItemsMap) {

        let usedItems = elementsItemsMap[key].map(({category_id}) => category_id);

        $(key).each(function (iterator, element) {

            let itemsToRemove = usedItems.filter(category_id => category_id !== parseInt($(element).val()));

            itemsToRemove.forEach(function (item) {
                $('option[value="' + item + '"]', element).remove();
            });

        })
    }

}

function selectedItemCategories(element, deleteElement) {

    let escape = -1;

    if(deleteElement !== undefined) {
        escape = parseInt(deleteElement.find(element).val());
    }

    let selectedItemCategories = [];

    $(element).each(function (iterator, el) {
        if(parseInt($(el).val()) !== parseInt(escape)) {
            selectedItemCategories.push(
                {
                    'category_id': parseInt($(el).val())
                }
            );
        }
    });

    return selectedItemCategories;
}

function addItemToOtherDropdownAfterDelete(elementsItemsMap, allItems, allValues, deleteElement) {

    let allSelectedValues = [];
    let difference = [];

    for (var key in elementsItemsMap) {

        if(deleteElement !== undefined) {
            deleteElement.remove();
        }

        allSelectedValues = elementsItemsMap[key].map(({category_id}) => category_id);

        $(key).each(function (iterator, element) {

            let currentSelectedValue = parseInt($(element).val());

            let tempAllSelectedValues = allSelectedValues.filter(x => parseInt(x) !== currentSelectedValue);

            difference = allValues.filter(x => !tempAllSelectedValues.includes(x));

            $(element).empty();

            difference.forEach(el => {
                let option = document.createElement('option');
                option.innerText = allItems[el];
                option.setAttribute('value', el);
                if(parseInt(el) === currentSelectedValue) {
                    option.setAttribute('selected', true);
                }
                $(element).append(option);
            });
        });

    }


}
