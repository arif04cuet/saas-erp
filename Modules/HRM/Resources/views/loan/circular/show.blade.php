@extends('hrm::layouts.master')
@section('title', trans('labels.details'))

@section('content')
    {{-- {{ dd($employee) }} --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">
                @lang('hrm::employee.loan.circular.title') @lang('labels.details')
            </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" style="">
            <div class="card-body">

                <div class="tab-content ">
                    <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                        aria-expanded="true">
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <th style="width: 20%">@lang('hrm::employee.loan.circular.loan_circular_title')</th>
                                    <td>{{ $circular->title }}</td>
                                </tr>

                                <tr>
                                    <th style="width: 20%">@lang('hrm::employee.loan.circular.reference_no')</th>
                                    <td>{{ $circular->reference_no }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::employee.loan.circular.circular_date')</th>
                                    <td>{{ \Carbon\Carbon::parse($circular->circular_date)->format('d F, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::employee.loan.circular.last_date_of_application')</th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($circular->last_date_of_application)->format('d F, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.details')</th>
                                    <td>
                                        <?php echo html_entity_decode($circular->details); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.status')</th>
                                    <td>{{ ucwords($circular->status) }}</td>
                                </tr>

                            </tbody>
                        </table>
                        {{-- <a href="{{url('/hrm/employee/')}}" --}}
                        <a class="btn btn-small btn-info" href="{{ route('loan-circulars.edit', $circular->id) }}">
                            <i class="ft ft-edit"></i> @lang('labels.edit')
                        </a>
                        <a class="btn btn-warning" href="{{ route('loan-circulars.index') }}">
                            <i class="ft ft-x"></i> @lang('labels.cancel')
                        </a>

                    </div>


                </div>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">


            </div>
        </div>
    </div>

@endsection
