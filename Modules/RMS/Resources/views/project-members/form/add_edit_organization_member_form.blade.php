<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('pms::member.member_adding_form') </h4>
    <h3>{{ $mode }}   <strong>({{ $organization->name }})</strong></h3>
    <div class="row " style="">
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                    {{ Form::label('name', trans('labels.name')) }}
                    {{ Form::text('name',  isset($member) ? $member->name : null,  ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter name', 'data-validation-required-message' => trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('name'))
                        <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group {{ $errors->has('mobile') ? ' error' : '' }}">
                    {{ Form::label('mobile', trans('labels.mobile')) }}
                    {{ Form::text('mobile',  isset($member) ? $member->mobile : null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter mobile no','data-validation-required-message'=>trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('mobile'))
                        <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('address', trans('labels.address')) }}
                    {{ Form::text('address',  isset($member) ? $member->address : null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization address']) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('gender') ? ' error' : '' }}">
                {{ Form::label('gender', trans('labels.gender'), ['class' => 'required']) }}
                {{ Form::select('gender',  ['male' => trans('labels.male'), 'female' => trans('labels.female')],  isset($member) ? $member->gender : null, ['placeholder' => trans('labels.select'), 'class' => 'form-control', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
                <div class="help-block"></div>
                @if ($errors->has('gender'))
                    <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('nid', trans('labels.nid_number')) }}
                    {{ Form::text('nid',  isset($member) ? $member->nid : null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter NID number']) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        {{ Form::hidden('organization_id', isset($organization->id) ? $organization->id : null) }}
        {{ Form::hidden('id', isset($member->id)  ? $member->id : null ) }}
    </div>
    <div class="row">
        <div class="form-actions col-md-12 ">
            <div class="pull-right">
                {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['id' => 'submitOrganization', 'type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="la la-times"></i> @lang('labels.cancel')
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
