@if($page == 'create')
    {!! Form::open(['route' =>  ['job-admit-cards.store'], 'class' => 'form admit-card-form', 'novalidate', 'method' => 'post']) !!}
@else
    {!! Form::open(['route' =>  ['job-admit-cards.update', $jobCircular->id], 'class' => 'form admit-card-form', 'novalidate', 'method' => 'put']) !!}
@endif
<div class="row">
    <div class="col-12">
        <table class="table">
            <tr>
                <th style="width: 20%">@lang('hrm::job-circular.title')</th>
                <td>
                    {{ $jobCircular->title ?? __('labels.not_found') }}
                    {!! Form::hidden('job_circular_id', $jobCircular->id) !!}
                </td>
            </tr>
            <tr>
                <th>@lang('job-application.job_circular_number')</th>
                <td>{{ $jobCircular->unique_id ?? __('labels.not_found') }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <!-- Exam Type -->
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('exam_type', trans('hrm::job-circular.admit_card.exam_type'), ['class' => 'form-label required'] ) }}
            {{ Form::select(
                'exam_type',
                __('hrm::job-circular.admit_card.exam_types'),
                $page == 'create' ? old('exam_type') : $admitCard->exam_type,
                [
                    'class' => 'form-control',
                ]
             )}}
            <div class="help-block"></div>
            @if ($errors->has('exam_type'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('exam_type') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <!-- Date of Exam -->
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('date_of_exam', trans('hrm::job-circular.admit_card.exam_date'), ['class' => 'required'] ) }}
            {{ Form::text('date_of_exam',
                $page == 'create' ? old('date_of_exam') : $admitCard->date_of_exam,
                [
                    'class' => 'form-control pickadate',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('date_of_exam'))
                <div class="help-block">  {{ $errors->first('date_of_exam') }}</div>
            @endif
        </div>
    </div>

    <!-- Time of Exam -->
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('time_of_exam', trans('hrm::job-circular.admit_card.exam_time'), ['class' => 'required'] ) }}
            {{ Form::text('time_of_exam',
                $page == 'create' ? old('time_of_exam') : $admitCard->time_of_exam,
                [
                    'class' => 'form-control pickatime',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('time_of_exam'))
                <div class="help-block">  {{ $errors->first('time_of_exam') }}</div>
            @endif
        </div>
    </div>

    <!-- Exam Center -->
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('exam_center', trans('hrm::job-circular.admit_card.exam_center'), ['class' => 'required'] ) }}
            {{ Form::text('exam_center',
                $page == 'create' ? old('exam_center') : $admitCard->exam_center,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('exam_center'))
                <div class="help-block">  {{ $errors->first('exam_center') }}</div>
            @endif
        </div>
    </div>

    <!-- Center Location -->
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('location', trans('hrm::job-circular.admit_card.exam_center') . ' ' . __('labels.address'),
                ['class' => 'required'] )
             }}
            {{ Form::text('location',
                $page == 'create' ? old('location') : $admitCard->location,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('location'))
                <div class="help-block">  {{ $errors->first('location') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="form-actions">
    <div class="center">
        {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
        <a href="{{ route('job-circular.index') }}">
            <button type="button" class="btn btn-warning mr-1">
                <i class="la la-times"></i> @lang('labels.cancel')
            </button>
        </a>
    </div>
</div>

{!! Form::close() !!}
