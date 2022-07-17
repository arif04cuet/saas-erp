@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.local_income'))


@section('content')


    <div class="container">


        <!-- General Information Card -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::accounts.general_information')</h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-8">
                                <table class="table">
                                    <tr>
                                        <th>@lang('accounts::fiscal-year.title')</th>
                                        <td>2017-2018</td>
                                        <th>@lang('accounts::budget.title')</th>
                                        <td>Sample Budget</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.variance.analysis') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <form action="#">


                        <!-- Budget Items Details -->
                        <div id="invoice-items-details" class="">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table repeater-category-request table-bordered">
                                        <thead>


                                        <tr class="text-center">
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>{{trans('accounts::accounts.title')}}</th>
                                            <th>{{trans('accounts::budget.total_allocation')}}</th>
                                            <th>{{trans('accounts::budget.revised_total_allocation')}}</th>
                                            <th>{{trans('accounts::budget.variance.actual_expenditure')}}</th>
                                            <th>{{trans('accounts::budget.variance.title')}}</th>
                                            {{--                                            <th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                                            {{--                                                              style="cursor: pointer"></i></th>--}}

                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="category">
                                        @for($i=0; $i<3; $i++)
                                            <tr data-repeater-item>
                                                <td scope="row">{{$i+1}}</td>

                                                <!-- account dropdown -->
                                                <td width="25%">
                                                    {!! Form::select('account_id', ['Accounts - 011', 'Accounts - 012','Accounts
                                                    - 013'], 1, [
                                                    'class' => 'form-control category-type-select readonly ',
                                                    'data-msg-required' => Lang::get('labels.This field is required'),
                                                    ]) !!}
                                                </td>
                                                <!-- Budgeted Amount -->
                                                <td> {!! Form::number('', 1000,['class' => 'form-control', 'readonly'])!!}</td>
                                                <!-- Revised Budgeted Amount -->
                                                <td> {!! Form::number('', 1200,['class' => 'form-control','readonly'])!!}</td>
                                                <!--Actual Expenditure-->
                                                <td> {!! Form::number('', 900,['class' => 'form-control','readonly'])!!}</td>
                                                <!--Variance-->
                                                <td> {!! Form::number('', 5.6,['class' => 'form-control','readonly'])!!}</td>
                                                {{--                                                <td><i data-repeater-delete class="la la-trash-o text-danger"--}}
                                                {{--                                                       style="cursor: pointer"></i></td>--}}
                                            </tr>
                                        @endfor

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/ Budget Items Details -->

                        <!-- Save & Cancel Button -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="la la-check-square-o"></i>@lang('labels.validate')
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

@endsection


@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>


    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        let categoryRepeater = $(`.repeater-category-request`).repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });


    </script>

@endpush
