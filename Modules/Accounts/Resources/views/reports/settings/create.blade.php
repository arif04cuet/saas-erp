@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.revenue_budget'))
@section('content')

    <!-- todo:: Fetch These Values As Constant From Model Class -->
    @if($resourceType ==='fixed')
        @include('accounts::local-budget.form.fixed-resource')
    @elseif($resourceType === 'temporary')
        @include('accounts::local-budget.form.temporary-resource')
    @else
        @include('accounts::local-budget.form.stock-resource')
    @endif

@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let counter = 4;
            var table = $('#receipt_table').DataTable({});
            // add a row
            $('#add_row').click(function () {
                let row = [
                    counter++, 1200, 'English Name - Bangla Name', '<td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>', '<td> {!! Form::number('', null,['class' => 'form-control'])!!}</td>'
                ];
                table.row.add(row).draw(false);
                table.page('last').draw(false);
            });
            // delete selected row
            $('#receipt_table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            $('#delete_row').click(function () {
                table.row('.selected').remove().draw(false);
            });


        });

    </script>
@endpush
