@extends('ims::layouts.master')

@section('title', trans('labels.new') .' '. trans('ims::inventory.inventory_request'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('labels.new') @lang('ims::inventory.inventory_request')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                @include('ims::inventory.request.partials.form.' . $page . '.detail')
            </div>
        </div>
    </div>
@stop

@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>
        let categoryRepeater = $(`.repeater-category-request`).repeater({
            show: function () {
                $(this).find('.unique-item-selector').next('.select2-container').remove();
                $(this).find('.unique-item-selector').select2({
                    placeholder: "{{__('labels.select')}}",
                });
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            @if($page == 'create')
            isFirstItemUndeletable: true
            @endif
        });
    </script>
@endpush
