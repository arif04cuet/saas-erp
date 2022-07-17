@extends('publication::layouts.master')
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
                                        <th>@lang('publication::publication.title')</th>
                                        <td>{{ $itemDetails->publication->publicationRequest->research->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('publication::inventory.previous_amount')</th>
                                        <td>{{ $itemDetails->previous_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('publication::inventory.available_amount')</th>
                                        <td>{{ $itemDetails->available_amount }}</td>
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
                                            <th>{{ trans('labels.date') }}</th>
                                            <th>{{ trans('publication::inventory.transaction_type') }}</th>
                                            <th>{{ trans('publication::inventory.amount') }}</th>
                                            <th>{{ trans('publication::inventory.case') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $transaction->date }}
                                                </td>
                                                <td>

                                                    @if ($transaction->reference_table_id == null)
                                                        {{ trans('publication::inventory.not_found') }}
                                                    @else
                                                        <a
                                                            href="{{ route('research-paper-free-requests.show', $transaction->reference_table_id) }}">
                                                            {{ $transaction->reference_table }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $transaction->quantity }}
                                                </td>
                                                <td>

                                                    @if ($transaction->status == 'add')
                                                        {{ trans('publication::inventory.added') }}
                                                    @else
                                                        {{ trans('publication::inventory.distributed') }}
                                                    @endif


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
                            <a href="{{ route('publication-inventories.index') }}" class="btn btn-danger">
                                <i class="la la-backward"></i> @lang('labels.back_page')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
