@if($page == 'create')
    {!! Form::open(['route' =>  ['recruitment-exams.store'], 'class' => 'form recruitment-exam-form', 'novalidate', 'method' => 'post']) !!}
@else
    {!! Form::open(['route' =>  ['recruitment-exams.update', $exam->id], 'class' => 'form recruitment-exam-form', 'novalidate', 'method' => 'put']) !!}
@endif

<h4 class="form-section">
    <i class="ft-grid"></i>
    @lang('hrm::job-circular.recruitment_exam.form')
</h4>

<div class="row">
    <!-- Exam Type -->
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('job_circular_id', trans('hrm::job-circular.title'), ['class' => 'form-label required'] ) }}
            {{ Form::select(
                'job_circular_id',
                 $circulars,
                $page == 'create' ? (old('job_circular_id') ?? $circularId) : $exam->job_circular_id,
                [
                    'class' => 'form-control select2',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                ]
             )}}
            <div class="help-block"></div>
            @if ($errors->has('job_circular_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('job_circular_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<h4 class="form-section"><i class="ft ft-list"></i>@lang('hrm::job-circular.recruitment_exam.mark_system')</h4>

<div class="row">
    <!-- Exam Types -->

    <div class="col-12">
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
                    <td>
                        {!! Form::number($total, $page == 'create' ? old($total) : $exam->$total ,
                            [
                                'class' => 'form-control',
                                'autocomplete' => 'off',
                                'data-rule-min' => 0,
                                'data-msg-min' => __('validation.gte.numeric',
                                ['attribute' => __('hrm::job-circular.recruitment_exam.total'), 'value' => 0]),
                                'data-rule-maxlength' => 3,
                                'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                            ])
                        !!}
                    </td>
                    <td>
                        {!! Form::number($pass, $page == 'create' ? old($pass) : $exam->$pass ,
                            [
                                'class' => 'form-control',
                                'autocomplete' => 'off',
                                'data-rule-min' => 0,
                                'data-msg-min' => __('validation.gte.numeric',
                                ['attribute' => __('hrm::job-circular.recruitment_exam.pass'), 'value' => 0]),
                                'data-rule-maxlength' => 3,
                                'data-msg-maxlength'=> trans('labels.At most 3 characters'),
                            ])
                        !!}
                    </td>

                </tr>
            @endforeach
        </table>
    </div>

</div>

<div class="form-actions">
    <div class="center">
        {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
        <a href="{{ route('recruitment-exams.index') }}">
            <button type="button" class="btn btn-warning mr-1">
                <i class="la la-times"></i> @lang('labels.cancel')
            </button>
        </a>
    </div>
</div>

{!! Form::close() !!}
