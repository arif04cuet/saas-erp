@extends('tms::layouts.master')

@section('title', trans('tms::training_type.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"></div>
            <div class="heading-elements">
                <a href="{{route('training-type.index')}}" class="btn btn-primary btn-sm"><i
                        class="ft-plus white"></i> {{trans('tms::training_type.create')}}</a>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h3 class="form-section"><i class="la la-tag"></i>
                    @lang('tms::training_type.details')
                </h3>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <table class="table">
                            <tr>
                                <th>@lang('tms::training_type.form_elements.name')</th>
                                <th>Parent</th>
                            </tr>
                            <tr>
                                <td>
                                    {{ $trainingType->getName() ?? trans('labels.not_found') }}
                                </td>
                                <td>
                                    {{ $trainingType->parent->name_bangla ?? trans('labels.not_found') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('tms::venue.partials.buttons.cancel',['route_name'=>'training-type.index','id'=>null])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
