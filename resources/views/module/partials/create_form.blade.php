{!! Form::open( [ 'route'=>['module.store'],'class'=>' form wizard-circle module-form ','novalidate','method'=>'post' ] ) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.name_en',[ 'value'=>null,])
            @include('module.partials.errors',[ 'name' => 'name_en' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.name_bn',[ 'value'=>null])
            @include('module.partials.errors',[ 'name' => 'name_bn' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.short_code',[ 'value'=>null])
            @include('module.partials.errors',[ 'name' => 'short_code' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('module.partials.form_field.slug',[ 'value'=>null])
            @include('module.partials.errors',[ 'name' => 'slug' ])
        </div>
    </div>
    <div class="col-md-6">
        @include('module.partials.buttons.save')
        @include('module.partials.buttons.cancel',['route_name'=>'module.list','id'=>null])
    </div>
</div>
{!! Form::close() !!}