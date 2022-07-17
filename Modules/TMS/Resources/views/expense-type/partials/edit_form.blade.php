{!! Form::open( [ 'route'=>['expense-type.update',$expense_type->id],'class'=>' form wizard-circle vanue-form ','novalidate','method'=>'put' ] ) !!}
<div class="row">
    <input type="hidden" name="id" value={{ $expense_type->id }}>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.name',[ 'value'=>$expense_type->title])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.name_bn',[ 'value'=>$expense_type->title_bn])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="form-group">
            @include('tms::expense-type.partials.form_field.doptor',[ 'doptors'=>$doptors,'doptor_id'=>$expense-type->doptor_id])
            @include('tms::expense-type.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div> --}}
    <div class="col-md-6">
        @include('tms::expense-type.partials.buttons.save')
        @include('tms::expense-type.partials.buttons.cancel',['route_name'=>'expense-type.index','id'=>null])
    </div>
</div>
{!! Form::close() !!}