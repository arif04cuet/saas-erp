@extends('hm::layouts.master')
{{--@section('title', __('hm::hostel_budget.page_title'))--}}
@section('title', trans('hm::hostel_budget.page_title'))
{{--@section("employee_create", 'active')--}}


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--                        <h4 class="card-title">{{ trans('hm::hostel_budget.list_card_title') }}</h4>--}}
                        <h4 class="card-title">{{ trans('hm::hostel_budget.list_card_title') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url('/hm/hostel-budgets/create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('hm::hostel_budget.budget_add_button') }}
                            </a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.name')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $statusAr = array(
                                            'APPROVED' => 'bg-success',
                                            'REJECTED' => 'bg-danger',
                                            'PENDING' => 'bg-warning',
                                            'REVIEWED' => 'bg-info',
                                        );
                                    @endphp

                                    @if(count($budgetTitles)>0)
                                        @foreach($budgetTitles as $title)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $title->name }}</td>
                                                <td>
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        @if($title->status==3)
                                                            <a href=" {{ route('hostel-budgets.edit',  $title->id )}}"
                                                               class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                        @endif
                                                        <a href=" {{ route('hostel-budgets.show',  $title->id )}}"
                                                           class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>

                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>


    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'pdf',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });


    </script>

@endpush
