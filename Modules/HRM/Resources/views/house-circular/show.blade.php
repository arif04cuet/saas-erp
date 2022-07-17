@extends('hrm::layouts.master')
@section('title', trans('hrm::house-circular.title'))

@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::house-circular.title')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-1">
                            <div class="d-flex flex-row">
                                <h3>@lang('hrm::house-circular.reference_no') - </h3>
                                <h3 class="ml-1">{{ $circular->reference_no }}</h3>
                            </div>
                            <div class="d-flex flex-row">
                                <h3>@lang('hrm::house-circular.last_date') - </h3>
                                <h3 class="ml-1">{{ $circular->apply_to }}</h3>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::house-details.house_type')</th>
                                    <th>@lang('hrm::house-details.house_id')</th>
                                    <th>@lang('hrm::house-circular.designation_level')</th>
                                    <th>@lang('hrm::house-circular.salary_grade')</th>
                                </thead>
                                <tbody>
                                    @foreach ($circular->circularCategories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->category->name }}</td>
                                            <td>
                                                @foreach ($category->circularHouses as $house)
                                                    {{ $house->house->house_id }} @if (!$loop->last),@endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($category->circularDesignations as $designation)
                                                    {{ $designation->designation->getName() }} @if (!$loop->last),@endif
                                                @endforeach
                                            </td>
                                            <td>{{ $category->category->eligible_from . ' - ' . $category->category->eligible_to }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="printDiv()">
                            <i class="la la-print"></i> @lang('labels.print')
                        </button>
                    </div>
                </div>
                <div id="print_report" class="hidden">
                    @include('hrm::house-circular.printable')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
    <script type="text/javascript">
        function printDiv() {
            var divToPrint = document.getElementById('print_report');

            var newWin = window.open('House Circular Print', 'Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

            newWin.document.close();

            setTimeout(function () {
                newWin.close();
            }, 10);
        }
    </script>
@endpush
