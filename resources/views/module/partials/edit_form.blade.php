{!! Form::open( [ 'route'=>['module.update',$module->id],'class'=>' form wizard-circle module-form ','novalidate','method'=>'put' ] ) !!}
<div class="row">
    <input type="hidden" name="id" value={{ $module->id }}>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.name_en',[ 'value'=>$module->name_en])
            @include('module.partials.errors',[ 'name' => 'name_en' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.name_bn',[ 'value'=>$module->name_bn])
            @include('module.partials.errors',[ 'name' => 'name_bn' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.short_code',[ 'value'=>$module->short_code])
            @include('module.partials.errors',[ 'name' => 'short_code' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.slug',[ 'value'=>$module->slug])
            @include('module.partials.errors',[ 'name' => 'slug' ])
        </div>
    </div>
    <div class="col-md-6">
        @include('module.partials.buttons.save')
        @include('module.partials.buttons.cancel')
    </div>
    </div>
{!! Form::close() !!}