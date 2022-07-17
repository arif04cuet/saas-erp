<!-- Basic form layout section start -->
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-basic">{{trans('accounts::budget.local_budget')}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">

                        </div>
                        <form class="form form-horizontal">
                            <div class="form-body">

                                <h4 class="form-section"><i
                                        class="ft-plus-circle"></i> {{trans('accounts::budget.local_budget_details.receipt')}}
                                </h4>
                                <!-- Receipt Table-->
                                <div class="table-responsive">

                                    <!-- Button: Add New Row -->
                                    <a id="add_row" class="btn btn-primary mb-2 text-white"><i
                                            class="ft-plus-circle"></i>&nbsp;
                                        Add new row</a>

                                    <!-- Button: Delete A Row -->
                                    <a id="delete_row" class="btn btn-primary mb-2 text-white"><i
                                            class="ft-minus-circle"></i>&nbsp;
                                        Delete selected row</a>

                                    <!-- Table -->
                                    <table id="receipt_table" class="table table-striped table-bordered text-center ">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>{{trans('accounts::budget.code')}}</th>
                                            <th>{{trans('accounts::budget.sector_details')}}</th>
                                            <th>{{trans('accounts::budget.total_allocation')}}</th>
                                            <th>{{trans('accounts::budget.revised_total_allocation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @for($i=0; $i<3; $i++)
                                            <tr>
                                                <td scope="row">{{$i+1}}</td>
                                                <td>1200</td>
                                                <td>English Name - Bangla Name</td>
                                                <td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>
                                                <td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>
                                            </tr>
                                        @endfor
                                        <!-- Overall Total -->
                                        <tr>
                                            <td colspan="3" class="text-center">Total</td>
                                            <!-- Datatable do not support Rowspan/Colspan -->
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td> {!! Form::number('', null,['class' => 'form-control','readonly'])!!}</td>
                                            <td> {!! Form::number('', null,['class' => 'form-control','readonly'])!!}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="form-section"><i
                                        class="ft-minus-circle"></i> {{trans('accounts::budget.local_budget_details.payment')}}
                                </h4>
                                <!-- Payment Table  -->
                                <div class="table-responsive">
{{--                                    <a id="add_row" class="btn btn-primary mb-2 text-white"><i class="ft-plus"></i>&nbsp;--}}
{{--                                        Add new row</a>--}}
                                    <table id="receipt_table" class="table table-striped table-bordered text-center ">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>{{trans('accounts::budget.code')}}</th>
                                            <th>{{trans('accounts::budget.sector_details')}}</th>
                                            <th>{{trans('accounts::budget.total_allocation')}}</th>
                                            <th>{{trans('accounts::budget.revised_total_allocation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @for($i=0; $i<3; $i++)
                                            <tr>
                                                <td scope="row">{{$i+1}}</td>
                                                <td>1200</td>
                                                <td>English Name - Bangla Name</td>
                                                <td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>
                                                <td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>
                                            </tr>
                                        @endfor
                                        <!-- Overall Total -->
                                        <tr>
                                            <td colspan="3" class="text-center">Total</td>
                                            <!-- Datatable do not support Rowspan/Colspan -->
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td> {!! Form::number('', null,['class' => 'form-control','readonly'])!!}</td>
                                            <td> {!! Form::number('', null,['class' => 'form-control','readonly'])!!}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- Save & Cancel Button -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i>@lang('labels.save')
                                </button>
                                <a class="btn btn-warning mr-1" role="button" href="#">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- // Basic form layout section end -->
