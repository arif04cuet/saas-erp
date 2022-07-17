@php
    if ($organizableType == \Illuminate\Support\Facades\Config::get('constants.research')) {
        $module = 'rms';
        $title = trans('rms::research_proposal.menu_title');
    } else {
        $module = 'pms';
        $title = trans('pms::project_proposal.menu_title');
    }
@endphp

@extends($module . '::layouts.master')
@section('title', $title)

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {{ Form::open(['route' => 'organizations.store', 'class' => 'form organization-form']) }}
                            <div class="form-body">
                                <h4 class="form-section"><i
                                        class="ft-grid"></i>
                                    @lang('pms::project_proposal.organization_add_form')
                                </h4>
                                <h4>
                                    @if ($organizableType == \Illuminate\Support\Facades\Config::get('constants.research'))
                                        @lang('rms::research_proposal.research_title') : {{ $organizable->title  }}
                                    @else
                                        @lang('pms::project_proposal.project_title') : {{ $organizable->title  }}
                                    @endif
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div
                                                class="form-group {{ $errors->has('organization_id') ? ' error' : '' }}">
                                                {{ Form::label('organization_id',  trans('pms::project_proposal.organization_name'),
                                                    ['class' => 'required']) }}
                                                {{ Form::select('organization_id', $organizationSelectOptions, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => trans('labels.select'),
                                                    'data-validation-required-message' => trans('labels.This field is required'),
                                                    'required'
                                                ]) }}

                                                <div class="help-block"></div>
                                                @if ($errors->has('organization_id'))
                                                    <div
                                                        class="help-block">  {{ $errors->first('organization_id') }}</div>
                                                @endif
                                            </div>
                                            {{ Form::hidden('organizable_type', $organizableType) }}
                                            {{ Form::hidden('organizable_id', $organizable->id) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row addNewOrganization "
                                     style="{{ $errors->has('name') ? '' : 'display: none'}}">

                                    <!-- Name -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                                                {{ Form::label('name', trans('pms::project_proposal.organization_name'),
                                                 ['class' => 'required']) }}
                                                <br/>
                                                {{ Form::text('name',  old('name'),  [
                                                    'id'=> 'name',
                                                    'class' => 'addOrganizationInput form-control required',
                                                    'placeholder' => 'Enter organization name',
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                    'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>100]),
                                                    'data-rule-maxlength' => 11,
                                                ]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('name'))
                                                    <div class="help-block">  {{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                                                {{ Form::label('email', trans('labels.email_address')) }}
                                                <br/>
                                                {{ Form::text('email',  null, [
                                                    'id'=> 'email',
                                                    'class' => ' form-control',
                                                    'maxlength' => 100,
                                                    'placeholder' => 'Enter organization email'
                                                ]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('email'))
                                                    <div class="help-block">  {{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mobile -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                {{ Form::label('mobile', trans('labels.mobile')) }}
                                                <br/>
                                                {{ Form::text('mobile',  null, [
                                                    'id'=> 'mobile',
                                                    'class' => ' form-control',
                                                    'placeholder' => 'Enter organization mobile',
                                                    'data-rule-maxlength' => 11,
                                                    'data-rule-minlength' => 7,
                                                    'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                                                    'data-msg-minlength'=> trans('labels.At least 7 characters')
                                                ]) }}
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                {{ Form::label('address', trans('labels.address')) }}
                                                <br/>
                                                {{ Form::text('address',  null, [
                                                    'id'=>'address',
                                                    'class' => ' form-control',
                                                    'maxlength' => 100,
                                                    'placeholder' => 'Enter organization address'
                                                ]) }}
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Division -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="division_id"
                                                       class="required">@lang('division.division')</label>
                                                {{ Form::select('division_id', $divisions, null, [
                                                    'class' => 'form-control select2 required',
                                                    'placeholder' => trans('labels.select'),
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                ]) }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- District -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <div class="form-group ">
                                                    <label for="district_id"
                                                           class="required">@lang('district.district')</label>
                                                    {{ Form::select('district_id', [], null, [
                                                        'class' => 'form-control select2 required',
                                                        'placeholder' => trans('labels.select'),
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                    ]) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Thana -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="thana_id" class="required">@lang('thana.thana')</label>
                                                {{ Form::select('thana_id', [], null, [
                                                    'class' => 'form-control select2 required',
                                                    'placeholder' => trans('labels.select'),
                                                     'data-msg-required' => trans('labels.This field is required'),
                                                ]) }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Union -->
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="union_id" class="required">@lang('union.union')</label>
                                                {{ Form::select('union_id', [], null, [
                                                    'class' => 'form-control select2 required',
                                                    'placeholder' => trans('labels.select'),
                                                     'data-msg-required' => trans('labels.This field is required'),
                                                ]) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="form-actions col-md-12 ">
                                        <div class="pull-right">
                                            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), [
                                                'id' => 'submitOrganization',
                                                'type' => 'submit',
                                                'class' => 'btn btn-primary'
                                            ]) }}
                                            <a href="{{ URL::previous() }}">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="la la-times"></i> @lang('labels.cancel')
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script src="{{ asset('js/address/cascade-dropdown.js') }}"></script>
    <script>
        function setInputDisableOption(status) {
            $('select[name=division_id], select[name=district_id], select[name=thana_id], select[name=union_id],' +
                '#union_id, #name, #email, #mobile, #address').attr('disabled', status);
        }

        function removeAlertBox(hasErrors) {
            if (hasErrors) {
                hasErrors = false;
            } else {
                $('.alert.alert-danger').remove();
            }
            return hasErrors;
        }

        $(document).ready(function () {
            $('input,select,textarea').jqBootstrapValidation('destroy');
            setInputDisableOption(true);

            let organisationSelectSelector = 'select[name=organization_id]';

            $(organisationSelectSelector).on('change', function (e) {
                hasErrors = removeAlertBox(hasErrors);

                let organizationSelectValue = $(this).val();

                if (organizationSelectValue == 'add_new') {
                    setInputDisableOption(false);
                    $('input:not([name=_token]):not([name*=organizable])').val('');
                    $('select[name=division_id], select[name=district_id], select[name=thana_id], select[name=union_id]')
                        .val('')
                        .trigger('change');
                    $(".addNewOrganization").show();
                    $(".addOrganizationInput").focus();
                } else if (organizationSelectValue == "") {
                    setInputDisableOption(true);
                    $(".addNewOrganization").hide();
                } else {
                    setInputDisableOption(true);
                    $(".addNewOrganization").hide();
                }
            });

            let hasErrors = '{!! $errors->any() !!}';
            if (hasErrors) {
                $(organisationSelectSelector).val(null).trigger('change');
            }
        });
    </script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function () {
            validateForm('.organization-form');
        });

    </script>
@endpush
