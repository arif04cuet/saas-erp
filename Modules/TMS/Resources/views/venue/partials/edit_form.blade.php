{!! Form::open( [ 'route'=>['venue.update',$venue->id],'class'=>' form wizard-circle vanue-form ','novalidate','method'=>'put' ] ) !!}
<div class="row">
    <input type="hidden" name="id" value={{ $venue->id }}>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::venue.partials.form_field.name',[ 'value'=>$venue->title])
            @include('tms::venue.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @include('tms::venue.partials.form_field.name_bn',[ 'value'=>$venue->title_bn])
            @include('tms::venue.partials.errors',[ 'name' => 'title' ])
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="form-group">
            @include('tms::venue.partials.form_field.doptor',[ 'doptors'=>$doptors,'doptor_id'=>$venue->doptor_id])
            @include('tms::venue.partials.errors',[ 'name' => 'title_bn' ])
        </div>
    </div> --}}
    <div class="col-md-6">
        @include('tms::venue.partials.buttons.save')
        @include('tms::venue.partials.buttons.cancel',['route_name'=>'venue.index','id'=>null])
    </div>
</div>
{!! Form::close() !!}