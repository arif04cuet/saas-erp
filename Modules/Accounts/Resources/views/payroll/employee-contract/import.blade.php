@extends('accounts::layouts.master')
@section('title', 'Import Employee Contract')
@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('accounts::employee-contract.import_contract_amount')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                        {{--<div class="heading-elements">--}}
                        {{--<a href="{{url('/tms/training/create')}}" class="btn btn-primary btn-sm"><i--}}
                        {{--class="ft-plus white"></i> {{trans('tms::training.create_button')}}</a>--}}
                        {{--</div>--}}

                    </div>
                    <div class="card-content collapse show">
                        {{--<label>{{trans('tms::training.trainee_import_to')}} : </label> <span class="badge
                        badge-info" style="font-weight: bold">{{$training->training_title}}</span></center>--}}
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                {!! Form::open(['route' =>  'employee-contracts.load-import', 'class' => 'form',
                                'novalidate','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="file" id="import_file"
                                                   name="import_file" required>
                                            <label class="label red" for="import_file">
                                                {{trans('accounts::employee-contract.import_file_type')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit" name="fetch_data">
                                                <i class="ft ft-file-plus"></i>
                                                {{trans('tms::training.file_import')}}
                                            </button>
                                            <a class="btn btn-primary"
                                               href="{{route('employee-contracts.generate-sample')}}">
                                                <i class="ft ft-download"></i>
                                                {{trans('tms::training.file_sample')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            {!! Form::open(['route' =>  'employee-contracts.store-import', 'class' => 'form', 'novalidate',
                            'method' => 'post']) !!}

                            <center>
                                @if(sizeof($contractData) && sizeof($errorList))
                                    <div class="alert bg-danger alert-dismissible" style="color: white">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button> {{trans('tms::training.trainee_import_data_error_alert')}}
                                    </div>
                                @endif
                                {{--@if(sizeof($contractData) && !sizeof($errorList))--}}
                                    {{--<button class="btn btn-success" type="submit" name="import_contract">--}}
                                        {{--<i class="ft ft-upload" aria-hidden="true"></i>--}}
                                        {{--{{trans('tms::training.save_imported')}}--}}
                                    {{--</button>--}}
                                {{--@endif--}}
                            </center>


                            <div class="col-md-12" style="overflow: auto">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr class="text-center">
                                        <th colspan="2">Employee Information</th>
                                        <th colspan="{{(sizeof($contractData))? count($contractData[1]) - 2 : 0}}">
                                            Salary Rules
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($contractData))
                                        @php
                                            $ruleCodes = $contractData[1];
                                        @endphp
                                        <input type="hidden" name="imported_file" value="{{$file?? null}}">
                                        <input type="hidden" name="rules" value="{{implode(',', $ruleCodes)}}">
                                        @foreach($contractData as $key1 => $datum)
                                            <tr>
                                                @foreach($datum as $key2 => $item)
                                                    <td>
                                                        @if(!empty($errorList[$key1][$key2]))
                                                            <div class="danger">
                                                                <i class="la la-info-circle" title="{{$errorList[$key1][$key2]}}"
                                                                   data-toggle="tooltip"></i>
                                                                {{$item?? ""}}
                                                            </div>
                                                        @else
                                                            @if($key1 > 1 && $key2 >1)
                                                                {{$item?? ""}}
                                                            @elseif($key1 > 1 && $key2 == 1)
                                                                {{$item?? ""}}
                                                            @else
                                                                {{$item?? ""}}
                                                            @endif
                                                        @endif

                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush