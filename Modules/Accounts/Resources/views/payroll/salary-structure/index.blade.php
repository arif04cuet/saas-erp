@extends('accounts::layouts.master')
@section('title',trans('accounts::salary-structure.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::salary-structure.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('salary-structures.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::salary-structure.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.name')</th>
                                    <th>@lang('accounts::salary-structure.reference')</th>
                                    <th>@lang('accounts::salary-structure.rules')</th>
                                    <th width="20%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($structures as $structure)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{route('salary-structures.show', $structure->id)}}">
                                                {{$structure->name}}
                                            </a>
                                        </td>

                                        <td>{{$structure->reference}}</td>
                                        <td>
                                            @if($structure->rules)
                                                @foreach($structure->rules as $rule)
                                                    <span class="badge badge-info">{{$rule->name}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{route('salary-structures.show',
                                            $structure->id)}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info" href="{{route('salary-structures.edit',
                                            $structure->id)}}">
                                                <i class="la la-pencil"></i>
                                            </a>

                                            {!! Form::open([
                                                     'method'=>'DELETE',
                                                     'url' => route('salary-structures.destroy', $structure->id),
                                                     'style' => 'display:inline'
                                                     ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('labels.delete'),
                                            'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
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

