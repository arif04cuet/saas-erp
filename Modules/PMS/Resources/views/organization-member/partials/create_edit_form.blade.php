<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('member.member_adding_form') </h4>
    <h3>{{ $mode }} <strong>({{ $organization->name }})</strong></h3>
    <div class="row " style="">
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('name', trans('labels.name'), ['class' => 'required']) }}
                {{ Form::text('name',  isset($member) ? $member->name : null,  [
                    'id'=>'',
                    'class' => ' form-control required' . ($errors->has('name') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter name',
                    'data-msg-required' => trans('labels.This field is required')
                    ]) }}
                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('age', trans('labels.dob')) }}
                <div class='input-group'>
                    {{ Form::text('dob', isset($member) && !empty($member->dob) ? \Carbon\Carbon::parse($member->dob)->format('d/m/Y') : null, [
                        'class' => 'form-control'
                    ]) }}
                    <div class="input-group-append">
                        <span class="input-group-text">
                          <span class="la la-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('mobile', trans('labels.mobile'), ['class' => 'required']) }}
                {{ Form::text('mobile',  isset($member) ? $member->mobile : null,    [
                    'id'=>'',
                    'class' => 'form-control required' . ($errors->has('mobile') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter mobile no',
                    'data-rule-maxlength' => 11,
                    'data-rule-minlength' => 7,
                    'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                    'data-msg-minlength'=> trans('labels.At least 7 characters'),
                    'data-msg-required'=>trans('labels.This field is required'),
                ]) }}
                <div class="help-block"></div>
                @if ($errors->has('mobile'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('address', trans('labels.address')) }}
                {{ Form::text('address',  isset($member) ? $member->address : null,    [
                    'id'=>'',
                    'class' => ' form-control',
                    'placeholder' => 'Enter organization address'
                ]) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('gender', trans('labels.gender'), ['class' => 'required']) }}
                {{ Form::select('gender',  ['male' => trans('labels.male'), 'female' => trans('labels.female')],  isset($member) ? $member->gender : null, [
                    'class' => 'form-control member-gender-select required ' . ($errors->has('gender') ? ' is-invalid' : ''),
                    'data-msg-required'=>trans('labels.This field is required')
                ]) }}
                <div class="help-block"></div>
                @if ($errors->has('gender'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('nid', trans('labels.nid_number')) }}
                {{ Form::text('nid',  isset($member) ? $member->nid : null,    [
                    'id'=>'',
                    'class' => ' form-control' . ($errors->has('nid') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter NID number',
                    'data-rule-minlength' => 10,
                    'data-msg-minlength'=> trans('labels.At least 10 characters'),
                    'data-rule-maxlength' => 20,
                    'data-msg-maxlength'=> trans('labels.At most 20 characters'),
                    'data-rule-number' => 'true',
                    'data-msg-number' => trans('labels.Please enter a valid number'),
                    ]) }}
                <div class="help-block"></div>
                @if ($errors->has('nid'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('is_active', trans('organization.active_member')) }}
                <br>
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::radio('is_active', 1, isset($member) ? ($member->is_active == true) : null) }}
                        {{ Form::label('is_active', trans('organization.yes')) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::radio('is_active', 0, isset($member) ? ($member->is_active == false) : null) }}
                        {{ Form::label('is_active', trans('organization.no')) }}
                    </div>
                </div>
                <div class="help-block"></div>
                @if ($errors->has('is_active'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                {{ Form::label('Member Code', trans('organization.member_code')) }}
                {{ Form::text('short_code',  isset($member) ? $member->short_code : null, [
                    'class' => ' form-control' . ($errors->has('short_code') ? ' is-invalid' : ''),
                    'placeholder' => 'Enter Member Code',
                    'data-rule-maxlength' => 30,
                    'data-msg-maxlength'=> trans('labels.At most 30 characters'),
                ]) }}
                <div class="help-block"></div>
                @if ($errors->has('short_code'))
                    <div class="help-block">{{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        {{ Form::hidden('organization_id', isset($organization->id) ? $organization->id : null) }}
        {{ Form::hidden('id', isset($member->id)  ? $member->id : null ) }}
        {{ Form::hidden('project_id', $project->id) }}
    </div>
    <div class="row">
        <div class="form-actions col-md-12 ">
            <div class="pull-right">
                {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['id' => 'submitOrganization', 'type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                <a href="{{ route('pms-organizations.show', [$project->id, $organization->id]) }}">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="la la-times"></i> @lang('labels.cancel')
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    {{-- page vendor js --}}
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    {{-- page vendor js end --}}
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('input[name=dob]').pickadate({
                format: 'dd/mm/yyyy',
                selectMonths: true,
                selectYears: 100,
                max: new Date(),
            });
        });
    </script>
@endpush
