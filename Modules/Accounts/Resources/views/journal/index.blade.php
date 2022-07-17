@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.title'))


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::journal.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('journal.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('accounts::journal.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="journal_table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('accounts::journal.table.name')</th>
                                        <th>@lang('accounts::journal.table.type')</th>
                                        <th>@lang('accounts::journal.table.department')</th>
                                        <th>@lang('accounts::journal.debit')</th>
                                        <th>@lang('accounts::journal.credit')</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($journals as $journal)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$journal->name ?? ''}}</td>
                                            <td>{{$journal->type->name ?? ''}}</td>
                                            <td>{{$journal->department->name ?? ''}}</td>
                                            <td>{{$journal->debitAccount->getNameWithCode() ?? ''}}</td>
                                            <td>{{$journal->creditAccount->getNameWithCode() ?? ''}}</td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="{{route('journal.edit',$journal->id)}}"
                                                               class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                        <a href="{{route('journal.show',$journal->id)}}"
                                                           class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.show')}}</a>
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
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            $('#journal_table').DataTable({
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>

@endpush
