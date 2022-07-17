@extends('accounts::layouts.master')
@section('title',trans('accounts::pension.configuration.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::pension.configuration.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('pension-configuration.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::pension.configuration.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.title')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pensionConfigurations  as $pensionConfiguration)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <a href="{{route('pension-configuration.show', $pensionConfiguration->id)}}">
                                                {{$pensionConfiguration->title}}</a>
                                        </td>
                                        <td>
                                            @if($pensionConfiguration->status == \Modules\Accounts\Entities\PensionConfiguration::status[0])
                                                <span
                                                    class="badge badge-success">@lang('accounts::pension.configuration.form_elements.status.active')</span>
                                            @else
                                                <span
                                                    class="badge badge-danger">@lang('accounts::pension.configuration.form_elements.status.inactive')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pensionConfiguration->status == \Modules\Accounts\Entities\PensionConfiguration::status[0])
                                                <a href="{{route('pension-configuration.status', $pensionConfiguration->id)}}"
                                                   class="btn btn-danger btn-sm"
                                                   title="{{trans('accounts::pension.configuration.form_elements.status.inactive')}}">
                                                    <i class="la la-times-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{route('pension-configuration.status', $pensionConfiguration->id)}}"
                                                   class="btn btn-success btn-sm"
                                                   title="{{trans('accounts::pension.configuration.form_elements.status.active')}}">
                                                    <i class="la la-check-circle"></i>
                                                </a>
                                            @endif

                                            <a href="{{route('pension-configuration.edit', $pensionConfiguration->id)}}"
                                               class="btn btn-primary btn-sm" title="{{trans('labels.edit')}}">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('pension-configuration.destroy', $pensionConfiguration->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => trans('labels.delete'),
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

