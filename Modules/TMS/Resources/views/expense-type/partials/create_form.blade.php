{!! Form::open( [ 'route'=>['expense-type.store'],'class'=>' form wizard-circle expense-type-form ','novalidate','method'=>'post' ] ) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.name',[ 'value'=>null,])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.name_bn',[ 'value'=>null])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.doptor',[ 'doptors'=>$doptors])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div> --}}
    <div class="col-md-6">
        @include('tms::expense-type.partials.buttons.save')
    </div>
</div>
{!! Form::close() !!}