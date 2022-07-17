@extends('tms::layouts.master')
@section('title', 'Import Trainee')

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('tms::training.trainee_card_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                        <div class="heading-elements">
                            <a href="{{url('/tms/training/create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{trans('tms::training.create_button')}}</a>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <center>
                            <label>{{trans('tms::training.trainee_import_to')}} : </label> <span class="badge badge-info" style="font-weight: bold">{{$training->title}}</span>
                            <span class="badge badge-danger" style="font-weight: bold">{{ $numberOfTraineeCanBeInFile}}</span>
                        </center>
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                {!! Form::open(['url' =>  '/tms/trainee/import/to/'.$trainingId, 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" type="file" id="import_file" name="import_file" required>
                                                <label class="label red" for="import_file">{{trans('tms::training.trainee_import_filetype_alert')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" name="fetch_trainee">{{trans('tms::training.file_import')}}</button>
                                                <a class="btn btn-primary" href="{{url('/files/import_trainee-2.xlsx')}}" >{{trans('tms::training.file_sample')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>

                            <!-- File data show and save part -->

                            {!! Form::open(['url' =>  '/tms/trainee/import/store/'.$trainingId, 'class' => 'form', 'novalidate', 'method' => 'post']) !!}

                            <center>
                                @if(isset($is_overFlow) )
                                        @if($is_overFlow != null)
                                            <div class="alert bg-danger alert-dismissible" style="color: white">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> {{$is_overFlow}}
                                            </div>
                                        @endif

                                    @else

                                        @if(sizeof($traineeList) && sizeof($traineeListErrors))
                                            <div class="alert bg-danger alert-dismissible" style="color: white">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> {{trans('tms::training.trainee_import_data_error_alert')}}
                                            </div>
                                        @elseif($training->no_of_trainee < ($traineeCount+count($traineeList)))
                                            <div class="alert bg-danger alert-dismissible" style="color: white">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> {{trans('tms::training.trainee_full')}}
                                            </div>
                                        @endif

                                        @if($isFormat === true)
                                            <p style='color:red'>@lang('tms::training.format_check')</p>
                                        @endif

                                        @if($isFormat === false)
                                                @if((sizeof($traineeList) && !sizeof($traineeListErrors)) && ($training->no_of_trainee >= ($traineeCount + count($traineeList))))
                                                    <button class="btn btn-success" type="submit" name="import_trainee"><i class="ft ft-upload" aria-hidden="true"></i> {{trans('tms::training.save_imported')}}</button>
                                                @endif
                                        @endif

                                @endif
                            </center>
                            <table id="myTable" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('tms::training.trainee_name')}}</th>
                                    <th>{{trans('tms::training.trainee_gender')}}</th>
                                    <th>{{trans('labels.mobile')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($isFormat === false)
                                    @if(isset($traineeList))
                                        @foreach($traineeList as $key=>$trainee)
                                            <tr @if(in_array($key, $traineeListErrors))  style='color:red' @endif>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{$trainee[0]." ".$trainee[1]}} <input type="hidden" name="trainee_first_name[]" value="{{$trainee[0]}}"><input type="hidden" name="trainee_last_name[]" value="{{$trainee[1]}}"></td>
                                                <td>{{$trainee[2]}}<input type="hidden" name="trainee_gender[]" value="{{$trainee[2]}}"></td>
                                                <td>{{$trainee[3]}} <input type="hidden" name="mobile[]" value="{{$trainee[3]}}"></td>
                                                <input type="hidden" name="bangle_full_name[]" value="{{$trainee[4]}}">
                                                <input type="hidden" name="english_full_name[]" value="{{$trainee[5]}}">
                                                <input type="hidden" name="dob[]" value="{{$trainee[6]}}">
                                                <input type="hidden" name="email[]" value="{{$trainee[7]}}">
                                                <input type="hidden" name="badge_name[]" value="{{$trainee[8]}}">
                                                <input type="hidden" name="badge_name_bn[]" value="{{$trainee[9]}}">
                                            </tr>

                                        @endforeach

                                    @endif
                                @endif

                                </tbody>
                            </table>
                            {!! Form::close() !!}
                            <!-- end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
