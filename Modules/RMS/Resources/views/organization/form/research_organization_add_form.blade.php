<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('pms::project_proposal.organization_add_form') </h4>
    <h4>@lang('rms::research_proposal.research_title') : {{ $research->title  }}</h4><br/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{--{{ dd($organizations->pluck('name', 'id')) }}--}}
                <div class="form-group {{ $errors->has('organization_id') ? ' error' : '' }}">
                    {{ Form::label('organization_id',  trans('pms::project_proposal.organization_name'), ['class' => 'required']) }}
                    {{ Form::select('organization_id',  $organizations, null,
                    ['class' => 'form-control addSelect2Class organizationSelect', 'placeholder' =>trans('labels.select'), 'data-validation-required-message'=>trans('labels.This field is required')]) }}

                    <div class="help-block"></div>
                    @if ($errors->has('organization_id'))
                        <div class="help-block">  {{ $errors->first('organization_id') }}</div>
                    @endif
                </div>
                {{ Form::hidden('organizable_type', $type) }}
                {{ Form::hidden('organizable_id', $research->id) }}
            </div>
        </div>
    </div>

    <div class="row addNewOrganization " style="{{ $errors->has('name') ? '' : 'display: none'}}">
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                {{ Form::label('name', trans('pms::project_proposal.organization_name'), ['class' => 'required']) }}
                    <br/>
                    {{ Form::text('name',  old('name'),  ['id'=>'', 'class' => 'addOrganizationInput form-control', 'placeholder' => 'Enter organization name', 'data-validation-required-message' => trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('name'))
                        <div class="help-block">  {{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                    {{ Form::label('email', trans('labels.email_address')) }}
                    <br/>
                    {{ Form::text('email',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization email']) }}
                    <div class="help-block"></div>
                    @if ($errors->has('email'))
                        <div class="help-block">  {{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('mobile', trans('labels.mobile')) }}
                    <br/>
                    {{ Form::text('mobile',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization mobile']) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('address', trans('labels.address')) }}
                    <br/>
                    {{ Form::text('address',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization address']) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-actions col-md-12 ">
            <div class="pull-right">
                {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['id' => 'submitOrganization', 'type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                <a href="{{ route('received-research-proposal.index') }}">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="la la-times"></i> @lang('labels.cancel')
                    </button>
                </a>

            </div>
        </div>
    </div>
</div>

</div>

@push('page-js')
    <script>
        $(document).ready(function () {
            // $(".addNewOrganization").hide();
            $('.organizationSelect').on('select2:select', function (e) {
                var value = $(".organizationSelect option:selected").val();
                if (value === 'other_organization') {
                    $('input,select,textarea').jqBootstrapValidation('destroy');
                    $('input,select,textarea').jqBootstrapValidation();
                    $(".addNewOrganization").show();
                    $(".addOrganizationInput").focus();
                } else if (value == "") {
                    $('input,select,textarea').jqBootstrapValidation();
                    $(".addNewOrganization").hide();
                } else {
                    $('input,select,textarea').jqBootstrapValidation('destroy');
                    $(".addNewOrganization").hide();

                }
            });
        });
    </script>
@endpush