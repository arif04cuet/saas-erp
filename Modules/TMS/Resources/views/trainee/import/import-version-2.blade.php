@extends('tms::layouts.master')
@section('title', trans('tms::trainee_import.title'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('tms::training.trainee_card_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <center>
                            <label>{{trans('tms::training.trainee_import_to')}} : </label> <span
                                class="badge badge-info" style="font-weight: bold">{{$training->title}}</span>
                            <span class="badge badge-danger"
                                  style="font-weight: bold">{{ $numberOfTraineeCanBeInFile}}</span>
                        </center>
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                {!! Form::open(['url' =>  route('trainee.import.show-data',$training), 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="file" id="import_file" name="import_file"
                                                   required>
                                            <label class="label red"
                                                   for="import_file">{{trans('tms::training.trainee_import_filetype_alert')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit"
                                                    name="fetch_trainee">{{trans('tms::training.file_import')}}</button>
                                            <a class="btn btn-primary"
                                               href="{{route('trainee.import.download-sample')}}">{{trans('tms::training.file_sample')}}</a>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- data part -->
                            @include('tms::trainee.import.data-form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
