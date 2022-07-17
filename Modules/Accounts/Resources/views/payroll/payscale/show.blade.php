@extends('accounts::layouts.master')
@section('title', trans('accounts::payscale.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::payscale.title') @lang('labels.show')</h4>
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
                            {!! Form::open() !!}
                            <h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::payscale.title')</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                                        {!! Form::label('title', $payscale->title, ['class' => 'form-control required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('active_from', trans('accounts::payscale.active_from'), ['class' => 'form-label ']) !!}
                                        {!! Form::label('active_from', date('d F, Y', strtotime($payscale->active_from)), ['class' => 'form-control ']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <!-- Invoice Items Details -->
                                    <div class="card-title">
                                        @lang('accounts::payscale.gradewise_basic')
                                    </div>
                                    <div class="col-md-12">
                                        <div id="invoice-items-details" class="">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table repeater-category-request table-bordered text-center" id="salary-rules-table">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('accounts::payscale.grade')<span class="red"> *</span></th>
                                                            <th>@lang('accounts::payscale.gradewise_basic') <span class="red"> *</span></th>
                                                            <th>@lang('accounts::payscale.percentage_of_increment') <span class="red"> *</span></th>
                                                            <th>@lang('accounts::payscale.no_of_increment') <span class="red"> *</span></th>
                                                            {{--<th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                                                            {{--style="cursor: pointer"></i></th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($salaryBasics as $basic)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{"Grade ".$basic->grade}}</td>
                                                                <td>{{$basic->basic_salary}}</td>
                                                                <td>{{$basic->percentage_of_increment}}</td>
                                                                <td>{{$basic->no_of_increment}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions text-center">
                                <a class="btn btn-primary" href="{{route('payscales.edit', $payscale->id)}}">
                                    <i class="la la-pencil"></i> @lang('labels.edit')
                                </a>
                                <a class="btn btn-warning mr-1" role="button" href="{{url(route('payscales.index'))}}">
                                    <i class="ft-x"></i> @lang('labels.back_page')
                                </a>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

