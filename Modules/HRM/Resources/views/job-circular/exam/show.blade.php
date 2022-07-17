@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">
                @lang('hrm::job-circular.recruitment_exam.title') @lang('labels.details')
            </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                </ul>
            </div>
        </div>
        <br>

        <div class="card-content collapse show" style="">
            <div class="card-body">
                <div class="tab-content">
                    <div aria-expanded="true">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="">@lang('labels.title')</th>
                                <td>{{optional($exam->circular)->title ?? __('labels.not_found')}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th>@lang('hrm::job-circular.admit_card.exam_type')</th>
                                <th>@lang('hrm::job-circular.recruitment_exam.total')</th>
                                <th>@lang('hrm::job-circular.recruitment_exam.pass')</th>
                            </tr>
                            @foreach(config('constants.recruitment_exams') as $type)
                                @php
                                $total = $type . '_total';
                                $pass = $type . '_pass';
                                @endphp
                                <tr>
                                    <td>
                                        {{__('hrm::job-circular.recruitment_exam.types.' . $type)}}
                                    </td>
                                    <td>{{ $exam->$total }}</td>
                                    <td>{{ $exam->$pass }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <a type="button" class="btn btn-success" href="{{route('recruitment-exams.edit', $exam->id)}}">
                    <i class="ft ft-edit"></i>
                    @lang('labels.edit')
                </a>
                <a type="button" class="btn btn-warning" href="{{route('recruitment-exams.index')}}">
                    <i class="ft ft-x"></i>
                    @lang('labels.cancel')
                </a>
            </div>
        </div>
    </div>

@endsection
