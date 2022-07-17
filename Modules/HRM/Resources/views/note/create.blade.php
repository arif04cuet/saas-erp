@extends('hrm::layouts.master')


@section('title', trans('hrm::note.title'))

@push('page-css')

    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endpush

@section('content')

    <!-- Basic Editor start -->
    <section id="basic">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::note.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">

                        <div class="card-body">

                            {{ Form::open(['route' =>  ['note.store'],
                             'class' => 'form  striped-rows form-bordered',
                             'novalidate', 'method' => 'post']) }}

                            <div class="form-group">

                                <!-- Note title -->
                                {{ Form::label('title', trans('labels.title'),
                                        ['class' => 'col-md-3 label-control required']) }}
                                {{Form::text('title',null,['class'=>'form-control','placeholder'=>'title'])}}
                                <div class="help-block"></div>
                                @if ($errors->has('title'))
                                    <div class="help-block text-danger">{{ $errors->first('title') }}</div>
                                @endif

                            <!-- Note Type  -->
                                {{ Form::label('note_type_id', trans('hrm::note.type'),
                                   ['class' => 'col-md-3 label-control required']) }}

                                {!! Form::select('note_type_id',$noteTypes,null,[
                                        'class'=>'form-control','placeholder'=>'Select a type'
                                    ])
                                !!}
                                <div class="help-block"></div>
                                @if ($errors->has('note_type_id'))
                                    <div class="help-block text-danger">{{ $errors->first('note_type_id') }}</div>
                                @endif

                            <!-- textarea -->
                                {{Form::text('details', null,['class'=>'tinymce'])}}
                                <div class="help-block"></div>
                                @if ($errors->has('details'))
                                    <div class="help-block text-danger">{{ $errors->first('details') }}</div>
                                @endif

                            <!--hidden -->
                                {{ Form::hidden('user_id', Auth::user()->id) }}
                            </div>

                            <!-- Button -->
                            {{Form::submit(trans('labels.save'),['class'=>'btn btn-outline-success']) }}

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Editor end -->

@endsection

@push('page-js')

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('theme/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
@endpush