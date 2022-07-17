<label for="doptors" class="required">{{trans('user-management.select_doptor')}}</label>
{{ Form::select("doptors", $doptors, $doptor_id ?? null,
    ["class"=>"form-control select2 @if($errors->has('title_bn')) is-invalid @endif", 
    "id"=>"doptor_id",
    'name'=>'doptor_id','placeholder' => trans('labels.select'),
    'data-validation-required-message'=> trans('tms::venue.msg.requied')
    ]) 
}}

@if ($errors->has('doptor_id'))
    <span class="invalid-feedback"><strong>{{ $errors->first('doptor_id') }}</strong></span>
@endif