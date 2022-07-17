@extends('accounts::layouts.master')
@section('title',trans('accounts::customer.index'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::customer.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('customer.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::customer.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>Name</th>
                                    <th width="25%">Type</th>
                                    <th width="25%">Email</th>
                                    <th>Receivable Account</th>
                                    <th width="15%">Payable Account</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @for($i=0;$i<3;$i++)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td> Pablo Escober</td>
                                        <td>Company</td>
                                        <td>narcos@gmail.com</td>
                                        <td>Code-001001</td>
                                        <td>Code-001002</td>
                                        <td>
                                            <a href=""
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => "#",
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

