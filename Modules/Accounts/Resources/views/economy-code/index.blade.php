@extends('accounts::layouts.master')
@section('title',trans('accounts::economy-code.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::economy-code.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('economy-code.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::economy-code.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('labels.code')</th>
                                    <th width="25%">@lang('labels.name') (বাংলা)</th>
                                    <th width="25%">@lang('labels.name') (English)</th>
                                    <th>@lang('labels.description')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($economyCodes as $code)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$code->code}}</td>
                                        <td>{{$code->bangla_name}}</td>
                                        <td>{{$code->english_name}}</td>
                                        <td>{{$code->description}}</td>
                                        <td>
                                            <a href="{{ route('economy-code.edit', $code->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('economy-code.destroy', $code->id),
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
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

