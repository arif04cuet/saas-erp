@extends('accounts::layouts.master')
@section('title',trans('accounts::economy-head.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::economy-head.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('economy-head.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::economy-head.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('labels.head')</th>
                                    <th width="25%">@lang('labels.name') (বাংলা)</th>
                                    <th width="25%">@lang('labels.name') (English)</th>
                                    <th>@lang('labels.description')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($economyHeads as $head)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$head->code}}</td>
                                        <td>{{$head->bangla_name}}</td>
                                        <td>{{$head->english_name}}</td>
                                        <td>{{$head->description}}</td>
                                        <td>
                                            <a href="{{ route('economy-head.edit', $head->id) }}" class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('economy-head.destroy', $head->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Economy head',
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

