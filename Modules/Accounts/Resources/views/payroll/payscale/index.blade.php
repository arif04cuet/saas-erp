@extends('accounts::layouts.master')
@section('title',trans('accounts::payscale.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::payscale.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('payscales.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::payscale.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination" style="text-align: center">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.title')</th>
                                    <th>@lang('accounts::payscale.active_from')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payscales as $payscale)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{route('payscales.show', $payscale->id)}}">{{$payscale->title}}</a></td>
                                        <td>{{date('d F, Y', strtotime($payscale->active_from))}}</td>
                                        <td>
                                            @if($payscale->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>

                                            @if($payscale->status)
                                                <a href="{{route('payscales.activation', $payscale->id)}}"
                                                   class="btn btn-danger btn-sm" title="Deactivate Payscale">
                                                    <i class="la la-times-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{route('payscales.activation', $payscale->id)}}"
                                                   class="btn btn-success btn-sm" title="Activate Payscale">
                                                    <i class="la la-check-circle"></i>
                                                </a>
                                            @endif

                                            <a href="{{route('payscales.edit', $payscale->id)}}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('payscales.destroy', $payscale->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Payscale',
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

