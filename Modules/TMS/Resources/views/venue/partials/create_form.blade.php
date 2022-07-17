{!! Form::open( [ 'route'=>['venue.store'],'class'=>' form wizard-circle vanue-form ','novalidate','method'=>'post' ] ) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::venue.partials.form_field.name',[ 'value'=>null,])
            @include('tms::venue.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::venue.partials.form_field.name_bn',[ 'value'=>null])
            @include('tms::venue.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="form-group">
            @include('tms::venue.partials.form_field.doptor',[ 'doptors'=>$doptors])
            @include('tms::venue.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div> --}}
    <div class="col-md-6">
        @include('tms::venue.partials.buttons.save')
    </div>
</div>
{!! Form::close() !!}