@extends('tms::layouts.master')

@section('title', trans('tms::training_year.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3 class="form-section"><i class="la la-tag black"></i>
                    @lang('tms::training_year.title')
                </h3>
            </div>
            <div class="heading-elements">
                <a href="{{route('training-year.index')}}" class="btn btn-primary btn-sm"><i
                        class="ft-plus white"></i> {{trans('tms::training_year.create')}}</a>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                
                <div class="row">
                    <div class="col-12 col-md-12">
                        <table class="table">
                            <tr>
                                <th>@lang('tms::training_type.form_elements.name')</th>
                                <td>
                                    {{ $trainingYear->getYear() ?? trans('labels.not_found') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-actions mb-lg-3">
                            @include('tms::venue.partials.buttons.cancel',['route_name'=>'training-year.index','id'=>null])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
