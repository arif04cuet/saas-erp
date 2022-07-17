@if($page == 'create')
    {!! Form::open(['route' =>  ['calendar-event.store'], 'class' => 'form calendar-event-form', 'novalidate', 'method' => 'post']) !!}
@else
    {!! Form::open(['route' =>  ['calendar-event.update', $calendarEvent->id], 'class' => 'form calendar-event-form', 'novalidate', 'method' => 'put']) !!}
@endif

<h3 class="form-section"><i class="ft-grid"></i> @lang('labels.new') @lang('hrm::calendar.event')</h3>

<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-1 col-12">
            {{ Form::label('title', trans('hrm::calendar.event_title'), ['class' => 'required']) }}
            {{ Form::text('title',
                $page == 'create' ? null : $calendarEvent->title,
                [
                    'required' => 'required',
                    'class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required'),
                    'maxlength' => 100
                ])
            }}
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <div class="help-block red">{{ $errors->first('title') }}</div>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group mb-1 col-12">
            {{ Form::label('title', trans('hrm::calendar.event_detail')) }}
            {{ Form::textarea('description',
                $page == 'create' ? null : $calendarEvent->description,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'maxlength' => 1000,
                    'rows' => 6
                ])
            }}
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <div class="help-block red">{{ $errors->first('description') }}</div>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-1 col-12">
            {!! Form::label('start', trans('hrm::calendar.event_start_date'), ['class' => 'required']) !!}
            {{ Form::text('start',
                $page == 'create' ? date('j F, Y') : \Carbon\Carbon::parse($calendarEvent->start)->format('j F, Y'),
                [
                    'id' => 'start',
                    'required' => 'required',
                    'class' => 'form-control required' . ($errors->has('start') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required')
                ])
            }}
            @if ($errors->has('start'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('start') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-1 col-12">
            {{ Form::label('end', trans('hrm::calendar.event_end_date'), ['class' => 'required']) }}
            {{ Form::text('end',
                $page == 'create' ? date('j F, Y') : \Carbon\Carbon::parse($calendarEvent->end)->format('j F, Y'),
                [
                    'id' => 'end',
                    'required' => 'required',
                    'class' => 'form-control required' . ($errors->has('end') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-msg-greaterThan="' . trans('labels.Must be greater than or equal to', ['attribute' => trans('hrm::calendar.event_end_date')]) .'"',
                ])
            }}
            @if ($errors->has('end'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('end') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-actions col-md-12">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] ) }}
            <a href="{{ route('calendar-event.index') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
{!! Form::close() !!}
