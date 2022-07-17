@extends('hrm::layouts.master')
@section('title', trans('hrm::job-circular.result.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::job-circular.result.title')</h4>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="tab-content">
                            <div aria-expanded="true">
                                <div class="mb-3 ">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <th>@lang('hrm::job-circular.title')</th>
                                            <td>{{ $circular->title }}</td>
                                        </table>
                                    </div>
                                </div>
    
                                <h4 class="mb-1">@lang('hrm::job-circular.exam_marks.applicant_list')</h4>
                                <table class="table table-striped table-bordered" id="resultInfo">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('hrm::job-circular.exam_marks.applicant_no')</th>
                                            <th>@lang('hrm::job-circular.exam_marks.applicant_name')</th>
    
                                            @if ($circular->hasPreliminaryExam())
                                                <th>@lang('hrm::job-circular.exam_marks.types.preliminary')</th>
                                            @endif
    
                                            @if ($circular->hasWrittenExam())
                                                <th>@lang('hrm::job-circular.exam_marks.types.written')</th>
                                            @endif
    
                                            @if ($circular->hasAptitudeExam())
                                                <th>@lang('hrm::job-circular.exam_marks.types.aptitude')</th>
                                            @endif
    
                                            @if ($circular->hasVivaExam())
                                                <th>@lang('hrm::job-circular.exam_marks.types.viva')</th>
                                            @endif
                                            <th>@lang('hrm::job-circular.result.total_marks')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('hrm::job-circular.result.selected')</th>
                                        </tr>
                                    </thead>
                                    @if ($circular->jobApplicantsResult->isNotEmpty())
                                        @foreach ($circular->jobApplicantsResult as $key => $result)
                                        <tr>
                                            {{ Form::hidden('job_application_id'.$key.'', $result->jobApplicant->id) }}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $result->jobApplicant->applicant_id }}
                                            </td>
                                            <td>
                                                {{ $result->jobApplicant->applicant_name }}
                                            </td>
                                            @if ($circular->hasPreliminaryExam())
                                                <td width="15%">{{ $result->preliminary }}</td>
                                            @endif
        
                                            @if ($circular->hasWrittenExam())
                                                <td width="15%">{{ $result->written }}</td>
                                            @endif
        
                                            @if ($circular->hasAptitudeExam())
                                                <td width="15%">{{ $result->aptitude }}</td>
                                            @endif
                                        
                                            @if ($circular->hasVivaExam())
                                                <td width="15%">{{ $result->viva }}</td>
                                            @endif
                                            <td>{{ $result->total_marks }}</td>
                                            <td class="status{{$key}}">{{ trans('job-application.'.$result->jobApplicant->status) }}</td>
                                            <td>{!! Form::checkbox('status'.$key.'', null, 
                                                $result->jobApplicant->status == "short_listed" ? false : true   , 
                                                [
                                                    'class' => 'selection'
                                                ]) !!}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">@lang('labels.empty_table')</td>
                                        </tr>
                                    @endif
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
@endsection
@push('page-js')
    <script>
        $('#resultInfo').on('click', '.selection', function() {
            let name = $(this).attr('name');
            let index = name.match(/\d+/).toString();
            let applicantId = $("input[name='job_application_id"+ index +"']").val();
            let status = $(`.status${index}`);
            let url = "{{ route('recruitment-exam-marks.final-selection') }}";
            let data = { 
                "job_application_id" : applicantId,
                "_token": "{{ csrf_token() }}",
            }
            $.post(url, data, function(response) {
                status.html(response);
            })
        })
    </script>
@endpush