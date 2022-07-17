@if($page == 'create')
    {!! Form::open([
        'route' => 'trainingOrganization.store',
        'class' => 'form training-organization-form',
        'novalidate', 'method' => 'post'])
    !!}
@else
    {!! Form::open([
    'route' => ['trainingOrganization.update', $trainingOrganization->id],
    'class' => 'form training-organization-form',
    'novalidate', 'method' => 'put'])
    !!}
@endif
<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label required">
                    {{trans('tms::organization.organization_name')}}
                </label>

                {{ Form::text('name',
                $page == 'create' ? null : $trainingOrganization->name,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 3,
                    'data-msg-minlength'=> trans('labels.At least 3 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="bangla_name" class="form-label required">
                    {{trans('tms::organization.organization_bangla_name')}}
                </label>

                {{ Form::text('bangla_name',
                $page == 'create' ? null : $trainingOrganization->bangla_name ?? null,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 3,
                    'data-msg-minlength'=> trans('labels.At least 3 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('bangla_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('bangla_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label required">
                    {{trans('tms::organization.organization_name')}}
                </label>

                {{ Form::text('name',
                $page == 'create' ? null : $trainingOrganization->name,
                [
                    'class' => 'form-control',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 3,
                    'data-msg-minlength'=> trans('labels.At least 3 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('organization.index') }}"
       style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>
{!! Form::close() !!}
