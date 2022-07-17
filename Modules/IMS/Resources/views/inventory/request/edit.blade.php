@extends('ims::layouts.master')

@section('title', trans('labels.edit').' '. trans('ims::inventory.inventory_request'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                @lang('ims::inventory.inventory_request_form_title', ['type' =>
__('ims::inventory.inventory_request_types.' . $type)])
                @lang('labels.edit')
            </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('inventory-request.index') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white"> @lang('ims::inventory.inventory_request') @lang('labels.list')</i>
                </a>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                @include('ims::inventory.request.partials.form.edit.' . $formType)
            </div>
        </div>
    </div>
@stop



@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    @if($formType == 'detail')
        <script type="text/javascript">

            let activeItemsOfThisRequest = [];
            let inactiveItemsOfThisRequest = [];

                    @if(isset($categories['items']))

            let allItemsValues = @json(array_keys($categories['items']));
            let inventoryItems = @json($categories['items'], JSON_UNESCAPED_UNICODE);
            @if(count($inventoryRequest->details))
                    @php
                        $activeDetails = $inventoryRequest->details->filter(function ($e){
                            return $e->category->is_active;
                        })->map(function ($e) {
                            return [ 'category_id' => $e->category_id , 'quantity' => $e->quantity ];
                        })->values();
                    @endphp

                activeItemsOfThisRequest = @json($activeDetails);
                    @endif
                    @endif
                    @if(isset($categories['bought']))

            let allBoughtItemsValues = @json(array_keys($categories['bought']));
            let inventoryBoughtItems = @json($categories['bought']);
            @if(count($inventoryRequest->details))
                    @php
                        $inactiveDetails = $inventoryRequest->details->filter(function ($e){
                            return !$e->category->is_active;
                        })->map(function ($e) {
                            return [ 'category_id' => $e->category_id , 'quantity' => $e->quantity ];
                        })->values();
                    @endphp

                inactiveItemsOfThisRequest = @json($inactiveDetails);
            @endif
            @endif

        </script>
        <script type="text/javascript" src="{{ asset('js/inventory-request/page.js') }}"></script>
    @endif

@endpush
