@extends('ims::layouts.master')

@section('title', trans('ims::inventory.title') .' '. trans('labels.details'))

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::inventory.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            <a href="{{ route('inventory.index') }}" class="btn btn-primary btn-sm">
                                <i class="ft-list white"> @lang('ims::inventory.title') @lang('labels.details')</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h4 class="form-section"><i
                                    class="la la-tag"></i> @lang('ims::inventory.title') @lang('labels.details')
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th>@lang('labels.name')</th>
                                            <td>{{ $inventoryItemCategory->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('ims::inventory.short_code')</th>
                                            <td>{{ $inventoryItemCategory->short_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('ims::inventory.type')</th>
                                            <td>@lang('ims::inventory.' . preg_replace('/\s+/', '_', $inventoryItemCategory->type))</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('ims::inventory.unit')</th>
                                            <td>{{ $inventoryItemCategory->unit}}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.status')</th>
                                            <td>
                                                <p class="{{ $inventoryItemCategory->is_active ? 'text-success' : 'text-danger' }}">
                                                    @lang('labels.' . ($inventoryItemCategory->is_active ? 'active' : 'inactive'))
                                                </p>
                                            </td>
                                        </tr>
                                        @if(auth()->user()->hasAnyRole('ROLE_INVENTORY_USER'))
                                            @if($inventoryItemCategory->price)
                                                <tr>
                                                    <th>@lang('ims::inventory.price')</th>
                                                    <td>{{ $inventoryItemCategory->price }}</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </table>
                                </div>
                                {{--                                @if(auth()->user()->hasAnyRole('ROLE_INVENTORY_USER'))--}}
                                {{--                                    <div class="col-md-4">--}}
                                {{--                                        --}}{{--                                    <h4 class="form-section">Add Price</h4>--}}
                                {{--                                        {!! Form::open(['route' =>  ['inventory-item-price-store'], 'class' => 'form inventory-item-price-form']) !!}--}}

                                {{--                                        <div class="form-group">--}}
                                {{--                                            {!! Form::label('price', trans('ims::inventory.price'), ['class' => 'form-label required']) !!}--}}
                                {{--                                            {!! Form::number('price', $inventoryItemCategory->price ? $inventoryItemCategory->price : null,--}}
                                {{--                                                [--}}
                                {{--                                                    'class' => 'form-control required'. ($errors->has('price') ? ' is-invalid' : ''),--}}
                                {{--                                                    "placeholder" => trans('ims::inventory.price'),--}}
                                {{--                                                    'data-msg-required' => trans('labels.This field is required'),--}}


                                {{--                                                ])--}}
                                {{--                                            !!}--}}


                                {{--                                        </div>--}}
                                {{--                                        {!! Form::hidden('inventory_item_category_id', $inventoryItemCategory->id) !!}--}}
                                {{--                                        <button type="submit" class="btn btn-primary">--}}
                                {{--                                            <i class="la la-check-square-o"></i> @lang('labels.save')--}}
                                {{--                                        </button>--}}
                                {{--                                        {!! Form::close() !!}--}}
                                {{--                                    </div>--}}
                                {{--                                @endif--}}
                                <div class="col-md-6">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>@lang('ims::inventory.location')</th>
                                            <th>@lang('ims::inventory.quantity')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($inventories as $inventory)
                                            @php
                                                static $total = 0;
                                                $locationId = $inventory->location_id;
                                            @endphp
                                            <tr>
                                                <td>{{ $locationName = $inventory->inventoryLocation->name }}</td>
                                                <td>
                                                    @if($inventoryItemCategory->type === config('constants.inventory_asset_types.fixed asset'))
                                                        @include("ims::inventory.view-modal")
                                                        <a data-toggle="modal" href="#"
                                                           title="{{__('ims::inventory.item.view_item')}}"
                                                           data-backdrop="false"
                                                           data-target="#item-modal-{{$locationId}}">
                                                            <strong>
                                                                {{ $inventory->quantity }}
                                                            </strong>
                                                        </a>
                                                    @else
                                                        {{ $inventory->quantity }}
                                                    @endif

                                                </td>
                                                @php
                                                    $total += $inventory->quantity;
                                                @endphp
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>@lang('ims::inventory.total')</th>
                                            <th>{{ $total }}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::report.inventory.transition_history')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="inventory-report-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::inventory.quantity')</th>
                                        <th>@lang('ims::inventory.type')</th>
                                        <th>@lang('ims::inventory.location_transitions')</th>
                                        <th>@lang('labels.date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $history->quantity }}</td>
                                            <td>{{ $history->type }} Flow</td>
                                            <td>
                                                @php
                                                    $location1 = $history->inventory->inventoryLocation->name;
                                                    if (is_null($history->ref_inventory_id)) {
                                                        $location2 = null;
                                                    } else {
                                                        $location2 = $history->referenceInventory->inventoryLocation->name;
                                                    }
                                                    $preposition = $history->type == 'OUT' ? 'to' : 'from';
                                                    $transition = is_null($location2) ? $location1 : $location1 . " <b>$preposition</b> " . $location2;
                                                @endphp
                                                {!! $transition !!}
                                            </td>
                                            <td>{{ $history->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <style type="text/css">
        .error {
            color: #FF4961 !important;
        }

        .dataTables_length {
            /*min-width: 1000px;*/
        }
    </style>
@endpush
@push('page-js')
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $('.inventory-item-price-form').validate({
            rules: {
                price: {
                    min: 1,
                    max: 999999999,
                },
            },
            messages: {
                price: {
                    min: "{{trans('ims::inventory.minimum_price_message')}}",
                    max: "{{trans('ims::inventory.maximum_price_message')}}",
                    number: "{{trans('ims::inventory.valid_number_message')}}",
                }

            }
        });

        let table = $('.inventory-report-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 4}
            ],
            "language": {
                "search": "{{ trans('labels.search') }}",
                "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "{{ trans('labels.next') }}",
                    "previous": "{{ trans('labels.previous') }}"
                },
            },

        });

        $('div.dataTables_length').append(`
            <label style="margin-left: 20px;">
                {{ trans('labels.filtered') }}
        <input style="display: inline; width: 62%;" class= "form-control form-control-sm calendar-input" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
{{ trans('labels.records') }}
        </label>
`);

        var dateRangePicker = $('input[name="daterange"]'),
            userLists = $('select.users-list'),
            selectedUser = "all",
            startDate = moment("{{ count($histories) ? $histories->first()->created_at->format('d-m-Y') : '01-05-2019'}}", 'DD-MM-YYYY'),
            endDate = moment("{{ count($histories) ? $histories->last()->created_at->format('d-m-Y') : '01-05-2019' }}", 'DD-MM-YYYY');

        dateRangePicker.daterangepicker({
            opens: 'center',
            startDate: startDate,
            endDate: endDate,
            locale: {
                format: 'DD-MM-YYYY'
            }

        }, function (start, end, label) {
            startDate = start;
            endDate = end;

        });


        dateRangePicker.on('apply.daterangepicker', function (e, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let date = moment(data[4], 'DD-MM-YYYY');

                    if (startDate == null && endDate == null) {
                        return true;
                    } else if (startDate == null && date <= endDate) {
                        return true;
                    } else if (endDate == null && date >= startDate) {
                        return true;
                    } else if (date <= endDate && date >= startDate) {
                        return true;
                    }

                    return false;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });


    </script>
@endpush
