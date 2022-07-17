@extends('hrm::layouts.master')
@section('title', trans('hrm::job-circular.exam_marks.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::job-circular.exam_marks.title')</h4>
                </div>

                {!! Form::open(['route' => 'recruitment-exam-marks.store', 'method' => 'post', 'class' => 'marks-form']) !!}
                @csrf
                {!! Form::hidden('method', $circular->recruitmentExamMarks->isEmpty() ? 'store' : 'update') !!}
                {!! Form::hidden('recruit_exam_id', $circular->recruitmentExam->id) !!}
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
                                <table class="table table-striped table-bordered">
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
                                        </tr>
                                    </thead>
                                    @foreach ($circular->shortlistedJobApplications as $key => $applicant)
                                    <tr>
                                        {!! Form::hidden('marks['.$key.'][marks_id]', 
                                            $applicant->recruitmentExamMark->id ?? null) !!}
                                        {!! Form::hidden('marks['.$key.'][job_circular_id]', $circular->id) !!}
                                        {!! Form::hidden('marks['.$key.'][job_application_id]', $applicant->id) !!}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $applicant->applicant_id }}
                                        </td>
                                        <td>
                                            {{ $applicant->applicant_name }}
                                        </td>
                                        @if ($circular->hasPreliminaryExam())
                                            <td width="15%">
                                                {!! Form::text('marks['.$key.'][preliminary]', 
                                                 $applicant->recruitmentExamMark->preliminary ?? null,
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('hrm::job-circular.exam_marks.types.preliminary'),
                                                    'max' => $circular->recruitmentExam->preliminary_total,
                                                    'data-msg-max' => trans('hrm::job-circular.exam_marks.marks_max', 
                                                        ['attribute' => $circular->recruitmentExam->preliminary_total])
                                                ]) !!}
                                            </td>
                                        @endif
    
                                        @if ($circular->hasWrittenExam())
                                            <td width="15%">
                                                {!! Form::text('marks['.$key.'][written]', 
                                                 $applicant->recruitmentExamMark->written ?? null,
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('hrm::job-circular.exam_marks.types.written'),
                                                    'max' => $circular->recruitmentExam->written_total,
                                                    'data-msg-max' => trans('hrm::job-circular.exam_marks.marks_max', 
                                                        ['attribute' => $circular->recruitmentExam->written_total])
                                                ]) !!}
                                            </td>
                                        @endif
    
                                        @if ($circular->hasAptitudeExam())
                                            <td width="15%">
                                                {!! Form::text('marks['.$key.'][aptitude]', 
                                                 $applicant->recruitmentExamMark->aptitude ?? null,
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('hrm::job-circular.exam_marks.types.aptitude'),
                                                    'max' => $circular->recruitmentExam->aptitude_total,
                                                    'data-msg-max' => trans('hrm::job-circular.exam_marks.marks_max', 
                                                        ['attribute' => $circular->recruitmentExam->aptitude_total])
                                                ]) !!}
                                            </td>
                                        @endif
    
                                        @if ($circular->hasVivaExam())
                                            <td width="15%">
                                                {!! Form::text('marks['.$key.'][viva]', 
                                                 $applicant->recruitmentExamMark->viva ?? null,
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('hrm::job-circular.exam_marks.types.viva'),
                                                    'max' => $circular->recruitmentExam->viva_total,
                                                    'data-msg-max' => trans('hrm::job-circular.exam_marks.marks_max', 
                                                        ['attribute' => $circular->recruitmentExam->viva_total])
                                                ]) !!}
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save & Cancel Button -->
                <div class="form-actions text-center mb-2">
                @if ($circular->recruitmentExam->status != 'completed')
                    <button type="submit" class="btn btn-primary" value="completed" name="submit" 
                        onclick="return confirm('{{ trans('hrm::job-circular.exam_marks.final_submit_alert') }}')">
                        <i class="ft-check-square"></i>
                        @lang('hrm::job-circular.exam_marks.final_submit')
                    </button>
                    <button type="submit" class="btn btn-success" value="submit" name="submit">
                        <i class="ft-check-square"></i>
                        @lang('labels.save')
                    </button>
                @endif
                    <a class="btn btn-warning mr-1" role="button" href="{{route('recruitment-exams.index')}}">
                        <i class="ft-x"></i> @lang('labels.cancel')
                    </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            validateForm('.marks-form')
        })
    </script>

@endpush