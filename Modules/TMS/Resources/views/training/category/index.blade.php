@extends('tms::layouts.master')

@section('title', 'Training Category')

@section('content')
    @if(count($trainingCategories))
        <form class="form training-category-form" method="post">
            <div class="category-parent-container" data-parent="">
                @php
                    $levelOneSibling = "";
                    $levelTwoSibling = "";
                    $depth = 0;
                @endphp
                @foreach($trainingCategories as $key => $category)
                    @if($category['level'] == 0)
                        @if($depth == 1)
            </div>
            <div class="ml-2 radio-error" data-sibling="{{ $levelOneSibling }}"></div>
            @php
                $depth--;
            @endphp
            @endif
            <div class="skin skin-flat">
                <fieldset>
                    {{ Form::radio(
                        'category_id',
                        $category['id'],
                        false,
                        [
                            'class' => 'required form-control',
                            'id' => $category['slug'],
                            'data-slug' => $category['slug'],
                            'data-level' => $category['level'],
                            'data-msg-required' => trans('labels.This field is required')
                        ]
                    )}}
                    <label for="{{ $category['slug'] }}">{{ $category['slug'] }}</label>
                </fieldset>
            </div>
            @elseif($category['level'] == 1)
                @if($depth == 0)
                    <div class="ml-2 category-level-{{ $category['level'] }}-container"
                         data-parent="{{ $category['parent'] }}">
                        @php
                            $levelOneSibling = $trainingCategories[$key-1]['slug'];
                            $depth++;
                        @endphp
                        @endif
                        @if($depth == 2)
                    </div>
                    <div class="ml-4 radio-error" data-sibling="{{ $levelTwoSibling }}"></div>
                    @php
                        $depth--;
                    @endphp
                @endif
                <div class="skin skin-flat">
                    <fieldset>
                        {{ Form::radio(
                            'category_id',
                            $category['id'],
                            false,
                            [
                                'class' => 'required form-control',
                                'id' => $category['slug'],
                                'data-slug' => $category['slug'],
                                'data-level' => $category['level'],
                                'data-msg-required' => trans('labels.This field is required')
                            ]
                        )}}
                        <label for="{{ $category['slug'] }}">{{ $category['slug'] }}</label>
                    </fieldset>
                </div>
            @elseif($category['level'] == 2)
                @if($depth == 1)
                    <div class="ml-4 category-level-{{ $category['level'] }}-container"
                         data-parent="{{ $category['parent'] }}">
                        @php

                            $levelTwoSibling = $trainingCategories[$key-1]['slug'];
                            $depth++;
                        @endphp
                        @endif
                        <div class="skin skin-flat">
                            <fieldset>
                                {{ Form::radio(
                                    'category_id',
                                    $category['id'],
                                    false,
                                    [
                                        'class' => 'required form-control',
                                        'id' => $category['slug'],
                                        'data-slug' => $category['slug'],
                                        'data-level' => $category['level'],
                                        'data-msg-required' => trans('labels.This field is required')
                                    ]
                                )}}
                                <label for="{{ $category['slug'] }}">{{ $category['slug'] }}</label>
                            </fieldset>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="row radio-error"></div>
                    <button type="submit" class="master btn btn-sm">Save</button>
        </form>
    @endif
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            let parentContainer = $('.category-parent-container'),
                levelOneContainer = $('.category-level-1-container'),
                levelTwoContainer = $('.category-level-2-container'),
                category = $('input[type=radio][name=category_id]'),
                trainingCategoryForm = $('.training-category-form'),
                categoryErrorContainers = '.category-error,#category-error';

            levelOneContainer.slideUp();
            levelTwoContainer.slideUp();

            category.on('ifChanged', function (e) {
                let selectedCategory = $(this),
                    selectedCategorySlug = selectedCategory.attr('data-slug'),
                    selectedCategoryLevel = selectedCategory.attr('data-level');

                    removeErrorElements(categoryErrorContainers);
                switch (selectedCategoryLevel) {
                    case '0':
                        levelOneContainer.each(function (iterator, item) {
                            let parent = $(item).attr('data-parent');

                            if (parent === selectedCategorySlug) {
                                $(item).slideDown();
                            } else {
                                $(item).slideUp();
                            }
                        });
                        break;
                    case '1':
                        levelTwoContainer.each(function (iterator, item) {
                            let parent = $(item).attr('data-parent');

                            if (parent === selectedCategorySlug) {
                                $(item).slideDown();
                            } else {
                                $(item).slideUp();
                            }
                        });
                        break;
                    case '2':
                        break;
                    default:
                        break;
                }
            });

            trainingCategoryForm.validate({
                ignore: 'input[type=hidden]',
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertBefore(element.parent().parent().parent().parent().siblings('.radio-error'));
                    } else {
                        error.insertBefore(element.parent().siblings('.radio-error'));
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    removeErrorElements(categoryErrorContainers);
                    canSubmit(category.filter(':checked'), levelOneContainer, levelTwoContainer) === true ? form.submit() : event.preventDefault();
                }
            });
        });

        let canSubmit = function (category, levelOneContainer, levelTwoContainer) {
                let slug = category.attr('data-slug'),
                    level = category.attr('data-level'),
                    result = true;
                switch (level) {
                    case '0':
                        return validateChildSelection(levelOneContainer, slug, level);
                    case '1':
                        return validateChildSelection(levelTwoContainer, slug, level);
                    case '2':
                        break;
                    default:
                        break;
                }
                return result;
            },
            validateChildSelection = function(container, slug, level) {
                if(container.filter('[data-parent=' + slug + ']').length > 0) {
                    showError(container.filter('[data-parent=' + slug + ']')[0], slug, level);
                    return false;
                }
                return true;
            },
            showError = function (item, parent, level) {
                errorElement(level).insertBefore($(item).siblings('div.radio-error[data-sibling=' + parent + ']'));
            },
            errorElement = function(level) {
                let margin = level === '0' ? 'ml-2' : 'ml-4';
                return $(`<label class="category-error danger ${margin}" for="danger">{{ trans('labels.This field is required') }}</label>`);
            },
            removeErrorElements = function (categoryErrorContainers) {

                $(categoryErrorContainers).each(function(iterator, item) {
                    $(item).remove();
                });
            }

    </script>
@endpush
