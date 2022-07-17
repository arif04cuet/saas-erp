@extends('tms::layouts.master')

@section('title', trans('tms::trainee_type.title'))

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><h4><i class="la la-tag black"></i>
                    @lang('tms::trainee_type.details')
                </h4></div>
                <div class="heading-elements">
                    <a href="{{route('trainee-type.index')}}" class="btn btn-primary btn-sm"><i
                            class="ft-plus white"></i> {{trans('tms::trainee_type.add_trainee')}}</a>
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
                                        {{ $trainingParticipant->title ?? trans('labels.not_found') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('tms::venue.partials.buttons.cancel',['route_name'=>'training-name.index','id'=>null])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
