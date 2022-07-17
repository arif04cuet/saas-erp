@extends('accounts::layouts.master')
@section('title', trans('accounts::accounts.title'))

@section('content')

    <div class="container">

        <!-- todo: Go through all journal and print out -->

{{--        <!-- Hostel Department -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6 col-sm-12">--}}
{{--                <div class="card border-left-warning border-left-3">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">Hostel Department</h4>--}}

{{--                    </div>--}}
{{--                    <div class="card-content collapse show">--}}
{{--                        <div class="card-body">--}}
{{--                            <table class="table">--}}
{{--                                <tr>--}}
{{--                                    <th>Journal Type</th>--}}
{{--                                    <td><span class="badge badge-default badge-warning round">Sale</span></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>Unpaid Invoices</th>--}}
{{--                                    <td><a href="#" class="card-link">4</a></td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <a href="{{route('invoice.create')}}" class="btn btn-info fa fa-plus"><i--}}
{{--                                    class="ft-plus-circle"></i>&nbsp;Create Invoice</a>--}}
{{--                            <div id="demochart1" class="height-200 "></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-md-6 col-sm-12">--}}
{{--                <div class="card border-left-warning border-left-3">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">Hostel Department</h4>--}}

{{--                    </div>--}}
{{--                    <div class="card-content collapse show">--}}
{{--                        <div class="card-body">--}}
{{--                            <table class="table">--}}
{{--                                <tr>--}}
{{--                                    <th>Journal Type</th>--}}
{{--                                    <td><span class="badge badge-default badge-info round">Purchase</span></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>Bills to pay</th>--}}
{{--                                    <td><a href="#" class="card-link">2</a></td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <a href="#" class="btn btn-info card-link"><i--}}
{{--                                    class="ft-plus-circle"></i>&nbsp;Create Bill</a>--}}
{{--                            <div id="demochart2" class="height-200 "></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

    </div>
@stop



@push('page-css')


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


@endpush

@push('page-js')

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript">


        new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'demochart1',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [{y: '2010', a: 28,}, {y: '2011', a: 40}, {y: '2012', a: 36}, {y: '2013', a: 48}, {
                y: '2014',
                a: 32
            }, {y: '2015', a: 42}, {y: '2016', a: 30}],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['amount'],
            behaveLikeLine: true,
            ymax: 60,
            resize: true,
            pointSize: 0,
            smooth: true,
            gridTextColor: '#bfbfbf',
            gridLineColor: '#c3c3c3',
            numLines: 6,
            gridtextSize: 14,
            lineWidth: 2,
            fillOpacity: 0.6,
            lineColors: ['#FF9149'],
            hideHover: 'auto',
        });
        new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'demochart2',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [{y: '2010', a: 5,}, {y: '2011', a: 8}, {y: '2012', a: 36}, {y: '2013', a: 18}, {
                y: '2014',
                a: 32
            }, {y: '2015', a: 42}, {y: '2016', a: 30}],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['amount'],
            behaveLikeLine: true,
            ymax: 60,
            resize: true,
            pointSize: 0,
            smooth: true,
            gridTextColor: '#bfbfbf',
            gridLineColor: '#c3c3c3',
            numLines: 6,
            gridtextSize: 14,
            lineWidth: 2,
            fillOpacity: 0.6,
            lineColors: ['#FF9149'],
            hideHover: 'auto',
        });


    </script>
@endpush
