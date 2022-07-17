@extends('accounts::layouts.master')
@section('title',trans('accounts::gpf.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::gpf.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('gpf-configurations.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>
                                @lang('labels.new')
                                @lang('accounts::gpf.configuration.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard" style="overflow: auto">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <td width="5%"><strong>@lang('labels.serial')</strong></td>
                                    <td>
                                        <strong>
                                            @lang('accounts::gpf.configuration.gpf_interest_percentage')
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            @lang('accounts::gpf.configuration.gpf_loan_interest_percentage')
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            @lang('accounts::gpf.configuration.min_gpf_percentage')
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            @lang('accounts::gpf.configuration.max_gpf_percentage')
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            @lang('accounts::gpf.configuration.max_loan_installment')
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            @lang('labels.status')
                                        </strong>
                                    </td>
                                    <td width="15%">
                                        <strong>
                                            @lang('labels.action')
                                        </strong>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($configurations as $configuration)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$configuration->gpf_interest_percentage}}</td>
                                        <td>{{$configuration->gpf_loan_interest_percentage}}</td>
                                        <td>{{$configuration->min_gpf_percentage}}</td>
                                        <td>{{$configuration->max_gpf_percentage}}</td>
                                        <td>{{$configuration->max_loan_installment}}</td>
                                        <td>
                                            @if($configuration->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('gpf-configurations.show', $configuration->id)}}"
                                               title="{{__('labels.show')}}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{route('gpf-configurations.edit', $configuration->id)}}"
                                               title="{{__('labels.edit')}}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {{--{!! Form::open([--}}
                                                    {{--'method'=>'DELETE',--}}
                                                    {{--'url' => route('gpf.destroy', $configuration->id),--}}
                                                    {{--'style' => 'display:inline'--}}
                                                    {{--]) !!}--}}
                                            {{--{!! Form::button('<i class="la la-trash-o"></i>', array(--}}
                                            {{--'type' => 'submit',--}}
                                            {{--'class' => 'btn btn-danger btn-sm',--}}
                                            {{--'title' => 'Delete GPF Record',--}}
                                            {{--'onclick'=> 'return confirm("Confirm delete?")',--}}
                                            {{--)) !!}--}}
                                            {{--{!! Form::close() !!}--}}
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

