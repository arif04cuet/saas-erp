@extends('pms::layouts.master')
@section('title', trans('attribute.create_attribute'))

@section('content')
    <div class="container">
        <div class="row match-height">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('attribute.create_attribute')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['attributes.store', $project->id], 'class' => 'form']) !!}
                            @include('attribute.partials.form', ['formTitle' => trans('attribute.attribute_create_form')])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection