@extends('ims::layouts.master')

@section('title', trans('ims::inventory.warehouse.list_page_title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::inventory.warehouse.list_page_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 10px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <h3 class="text-center">Hostel</h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.code.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.name.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.quantity.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.alert_quantity.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.0.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.1.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.2.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.3.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.4.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.5.title')</th>
                                        <th>@lang('ims::inventory-list-table.warehouse.columns.departments.6.title')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>12</td>
                                        <td>Chair</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>134</td>
                                        <td>Light</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>23</td>
                                        <td>Table</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>26</td>
                                        <td>Fan</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>12</td>
                                        <td>Chair</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>134</td>
                                        <td>Light</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>23</td>
                                        <td>Table</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>26</td>
                                        <td>Fan</td>
                                        <td>2100</td>
                                        <td>20</td>
                                        <td>200</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>100</td>
                                        <td>400</td>
                                        <td>400</td>
                                        <td>800</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop