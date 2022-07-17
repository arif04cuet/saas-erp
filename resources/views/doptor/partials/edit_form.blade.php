{!! Form::open( [ 'route'=>['doptors.update',$doptor->id],'class'=>' form wizard-circle doptor-form ','novalidate','method'=>'put' ] ) !!}
<div class="row">
    <input type="hidden" name="id" value={{ $doptor->id }}>
    <div class="col-md-6">
        <div class="form-group">
            @include('doptor.partials.form_field.name_eng',[ 'value'=>$doptor->name_eng])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('doptor.partials.form_field.name_bng',[ 'value'=>$doptor->name_bng])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('doptor.partials.form_field.module_name',[ 'module'=>$module,'doptor'=>$doptor])
        </div>  
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        @include('doptor.partials.buttons.save')
        @include('doptor.partials.buttons.cancel')
    </div>
    </div>
{!! Form::close() !!}