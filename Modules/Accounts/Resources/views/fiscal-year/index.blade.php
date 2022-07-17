@extends('accounts::layouts.master')
@section('title',trans('accounts::fiscal-year.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::fiscal-year.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('fiscal-year.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::fiscal-year.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('labels.name')</th>
                                    <th>@lang('labels.start')</th>
                                    <th>@lang('labels.end')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fiscalYears as $fiscalYear)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $fiscalYear->name }}</td>
                                        <td>{{ $fiscalYear->start }}</td>
                                        <td>{{ $fiscalYear->end }}</td>
                                        <td>
                                            <a href="{{ route('fiscal-year.edit', $fiscalYear->id) }}" class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('fiscal-year.destroy', $fiscalYear->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Fiscal Year',
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

