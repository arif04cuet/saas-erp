@extends('ims::layouts.master')

@section('title', trans('ims::warehouse.list_page_title'))

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::product.list_page_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            <a href="{{ route('inventory.warehouse.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white">@lang('ims::warehouse-list-table.links.add')</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('ims::warehouse-list-table.columns.name')</th>
                                        <th>@lang('ims::warehouse-list-table.columns.department')</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($warehouses as $warehouse)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href="{{ route('inventory.warehouse.show', $warehouse->id) }}">{{ $warehouse->name }}</a></td>
                                            <td>{{ $warehouse->departments->name }}</td>
                                            <td>
                                            <span class="dropdown">
                                                <button id="imsWarehouseList" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="imsWarehouseList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a href="{{ route('inventory.warehouse.show', $warehouse->id) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                    <a href="{{ route('inventory.warehouse.edit', $warehouse->id) }}" class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                    <div class="dropdown-divider"></div>

                                                    {!!

                                                        Form::open([
                                                          'method'=>'DELETE',
                                                          'url' => [''],
                                                          'style' => 'display:inline'
                                                            ])
                                                     !!}

                                                    {!!
                                                       Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                       'type' => 'submit',
                                                       'class' => 'dropdown-item',
                                                       'title' => 'Delete the user',
                                                       'onclick'=>'return confirm("Confirm delete?")',
                                                               ))
                                                               !!}
                                                    {!! Form::close() !!}
                                                </span>
                                            </span>
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
        </div>
    </section>
@stop
