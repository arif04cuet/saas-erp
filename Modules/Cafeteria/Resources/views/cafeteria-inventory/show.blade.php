@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::inventory.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::inventory.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="card-content show">
                    <div class="card-body">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>@lang('cafeteria::raw-material.title')</th>
                                    <td>
                                        {{ $itemDetails->rawMaterial->getName()
                                                ?? trans('labels.not_found') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::inventory.previous_amount')</th>
                                    <td>{{ $itemDetails->previous_amount }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::inventory.present_amount')</th>
                                    <td>{{ $itemDetails->available_amount }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::raw-material-category.title')</th>
                                    <td>
                                        {{ $itemDetails->rawMaterial->rawMaterialCategory
                                            ? $itemDetails->rawMaterial->rawMaterialCategory->getName()
                                            : trans('labels.not_found') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('cafeteria::unit.title')</th>
                                    <td>
                                        {{ $itemDetails->rawMaterial->unit->getName()
                                                ?? trans('labels.not_found') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <h4 class="card-title">@lang('cafeteria::inventory.inventory_transaction')</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('cafeteria::inventory.transaction_type')}}</th>
                                        <th>{{trans('cafeteria::purchase-list.quantity')}}</th>
                                        <th>{{trans('cafeteria::inventory.case')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        @if ($transaction->status == 'initiated')
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $transaction->date }}</td>
                                                <td>{{ $transaction->status }}</td>
                                                <td>{{ $transaction->quantity }}</td>
                                                <td>{{ $transaction->status }}</td>
                                            </tr>
                                            @continue;
                                        @endif
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $transaction->date }}
                                            </td>
                                            <td>
                                               <a href="{{ $transaction->reference_table_id == 0 ? route($transaction->reference_table.'.index') : route($transaction->reference_table.'.show', $transaction->reference_table_id) }}">{{ $transaction->reference_table }}</a>
                                            </td>
                                            <td>
                                                {{ $transaction->quantity }}
                                            </td>
                                            <td>
                                                {{ $transaction->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('cafeteria-inventories.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
