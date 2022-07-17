@extends('mms::layouts.master')
@section('title', trans('mms::medicine_distribution.site_title'))
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::medicine_distribution.medicine')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2 display-flax" style="margin-right: 10px;">

                <a href="{{ route('inventories.prescribed.index') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white"> @lang('mms::medicine_distribution.distribution_list')</i>
                </a>
                @if(!empty($medicinelist['distribution']->prescription_id))
                    <a href="{{ route('prescription.show',$medicinelist['distribution']->prescription_id) }}"
                       class="btn btn-sm btn-info" target="_blank"><i
                            class="ft-eye"></i> @lang('mms::prescription.title')
                    </a>
                @endif
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i
                        class="la la-tag"></i> @lang('mms::medicine_distribution.medicine') @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <table class="table">
                            <tr>
                                <th>@lang('mms::medicine_distribution.id')</th>
                                <td>{{$medicinelist['distribution']->patient_id}}</td>

                            </tr>
                            <tr>
                                <th>@lang('mms::medicine_distribution.name')</th>
                                <td>{{$medicinelist['distribution']->patient->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine_distribution.date')</th>
                                <td>{{ date('d-m-Y', strtotime($medicinelist['distribution']->date)) }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-12 col-md-7">
                        <table class="table mt-3 mt-md-0">
                            <tr>
                                <th>{{trans('mms::medicine_distribution.medicine')}}</th>
                                <th>{{trans('mms::medicine_distribution.piece')}}</th>
                            </tr>
                            @foreach($medicinelist['distributionHistory'] as $info)
                                <tr>
                                    <td>{{$info->medicine->name}}</td>
                                    <td>{{$info->quantity}}</td>
                                </tr>
                            @endforeach

                        </table>

                    </div>


                </div>

                <div class="col-md-5" style="margin-top: 15px;">
                    <h4 class="form-section"><i class="la la-tag"></i> @lang('mms::medicine_distribution.prescription')
                    </h4>
                    @if(!empty($medicinelist['distribution']->acknowledgement_slip))
                        <img src="{{ '/file/get?filePath='.$medicinelist['distribution']->acknowledgement_slip }}"
                             style="width: 100%; max-height: 500px; border: 1px #EEE solid" id="prescription_img">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')

@endpush
