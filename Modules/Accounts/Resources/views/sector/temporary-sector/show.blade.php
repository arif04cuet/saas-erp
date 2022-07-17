@extends('accounts::layouts.master')
@section('title',trans('accounts::economy-code.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::sector.temporary.index') </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('economy-code.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::sector.temporary.create')
                            </a>
                        </div>
                    </div>


                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('accounts::fiscal-year.title')</th>
                                    <th>@lang('labels.code')</th>
                                    <th width="25%">@lang('labels.name') (বাংলা)</th>
                                    <th width="25%">@lang('labels.name') (English)</th>
                                    <th>@lang('labels.description')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=1;$i<=3;$i++)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>2017-2018</td>
                                        <td>Sample Code</td>
                                        <td>English Name</td>
                                        <td>Bangla Name</td>
                                        <td>Description</td>
                                        <td>
                                            <a href="#"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => '#',
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Economy Code',
                                            'onclick'=> 'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

