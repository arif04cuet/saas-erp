@extends('accounts::layouts.master')
@section('title',trans('accounts::pension.deduction.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::pension.deduction.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('pension.deduction.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::pension.deduction.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('labels.name')</th>
                                    <th>@lang('labels.description')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pensionDeductions  as $pensionDeduction)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $pensionDeduction->name. " - ". $pensionDeduction->bangla_name ?? ''}}
                                        </td>
                                        <td>
                                            {{ $pensionDeduction->description  ?? ''}}
                                        </td>
                                        <td>
                                            <a href="{{route('pension.deduction.edit', $pensionDeduction->id)}}"
                                               class="btn btn-primary btn-sm" title="{{trans('labels.edit')}}">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('pension.deduction.destroy', $pensionDeduction->id),
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

