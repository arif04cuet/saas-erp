{!! Form::open(['route' =>  ['circular.store'], 'class' => 'form circularForm', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
<h3 class="form-section"><i class="ft-grid"></i> @lang('labels.new') @lang('hrm::circular.title')</h3>

<div class="row">
    <div class="col-6">
        {{ Form::label('recipient', trans('labels.recipient'), ['class' => '']) }}
        {{ Form::select('recipient[]',
            $users, null,
            [
                'class' => 'select2 recipient form-control'.($errors->has('recipient') ? ' is-invalid' : ''),
                'multiple',
                'data-rule-recipient-or-department' => 'department[]',
                'data-msg-recipient-or-department' => trans('hrm::circular.recipient_or_department')
            ])
        }}
        <div class="help-block"></div>
        @if ($errors->has('recipient'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('recipient') }}</strong>
                </span>
        @endif
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('department', trans('hrm::department.department'), ['class' => 'form-label']) !!}
            {!! Form::select('department[]',
                $departments, null,
                [
                    'class' => "form-control select2" . ($errors->has('department') ? ' is-invalid' : ''),
                    'multiple',
                    'data-rule-recipient-or-department' => 'recipient[]',
                    'data-msg-recipient-or-department' => trans('hrm::circular.recipient_or_department')
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('department'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', trans('labels.title'), ['class' => 'required'] ) }}
            {{ Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => '',
                'required' => 'required', 'maxlength' => 100,'data-msg-required'=>trans('labels.This field is required')])
            }}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('expiry_date', trans('hrm::circular.expiry_date'), ['class' => 'required']) }}
            {{ Form::text('expiry_date', date('j F, Y'),
                [
                    'id' => 'expiry_date',
                    'required' => 'required',
                    'class' => 'form-control required' . ($errors->has('expiry_date') ? ' is-invalid' : ''),
                    'data-msg-required' => trans('labels.This field is required')
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('expiry_date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('expiry_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('attachment', __('labels.attachments'), ['class' => 'form-label']) !!}
            {!! Form::file('attachment', [
            'class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : ''),
            'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf',
            'data-rule-attachment-or-details' => 'details',
            'data-msg-attachment-or-details' => trans('hrm::circular.attachment_or_details')
            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('attachment'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('attachment') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('details', trans('labels.details'), ['class' => '']) }}
            {{ Form::textarea('details', null,
                [
                    'class' => 'form-control' . ($errors->has('details') ? ' is-invalid' : ''),
                    'data-rule-attachment-or-details' => 'attachment',
                    'data-msg-attachment-or-details' => trans('hrm::circular.attachment_or_details')
                ])
            }}
            <div class="help-block"></div>
            @if ($errors->has('details'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('details') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('labels.save')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('complaint.create')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>
{!! Form::close() !!}

@push('page-js')
    <script>
        $(function () {
            $('.recipient').prepend(`<option value='{{\Modules\HRM\Entities\Circular::PUBLIC_CIRCULAR}}'>All</option>"`);
        });
        $(document).ready(function () {
            jQuery.validator.addMethod(
                'attachment-or-details',
                function (value, element, params) {
                    let alternative;
                    if(params === 'details') {
                        alternative = $('[name=details]').val();
                    }else {
                        alternative = $('input[type=file][name=attachment]').val();
                    }

                    return (value || alternative);
                },
                "{{ trans('hrm::circular.attachment_or_details') }}"
            );

            jQuery.validator.addMethod(
                'recipient-or-department',
                function (value, element, params) {
                    let alternative = $('[name="' + params + '"]').val();
                    return (value.length || alternative.length);
                },
                "{{ trans('hrm::circular.recipient_or_department') }}"
            );
        });
    </script>
@endpush