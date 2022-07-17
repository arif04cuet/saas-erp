@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::special-service.bill.title'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cafeteria::special-service.bill.title') @lang('labels.show')</h4>
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
                                        <th>@lang('cafeteria::cafeteria.group')</th>
                                        <td>
                                            @if (app()->isLocale('en'))
                                                {{ $bill->specialGroup->en_name }}
                                            @else
                                                {{ $bill->specialGroup->bn_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::special-service.special_group.advance_amount')</th>
                                        <td>{{ $bill->advance_amount ? $bill->advance_amount : 0 }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::special-service.bill.payment')</th>
                                        <td>{{ $bill->payment }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('cafeteria::special-service.bill.due_total')</th>
                                        <td>{{ $bill->due_total }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.remarks')</th>
                                        <td>{{ $bill->remark }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>{{ trans('labels.date') }}</th>
                                            <th>{{ trans('cafeteria::cafeteria.member') }}</th>
                                            <th>{{ trans('cafeteria::special-service.bill.charge') }}</th>
                                            <th>{{ trans('labels.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bill->specialGroupBillLists as $list)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $list->bill_date }}
                                                </td>
                                                <td>
                                                    {{ $list->member }}
                                                </td>
                                                <td>
                                                    {{ $list->charge }}
                                                </td>
                                                <td>
                                                    {{ $list->member * $list->charge }}
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
                            <a href="{{ route('special-group-bills.index') }}" class="btn btn-danger">
                                <i class="la la-backward"></i> @lang('labels.back_page')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
