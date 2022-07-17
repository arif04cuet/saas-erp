@extends('vms::layouts.master')

{{--@section('title', trans('labels.HRM'))--}}
@section('title', 'VMS')

@push('page-css')
    <style>

        .card .mh-35 {
            min-height: 40px;
            height: 40px;
        }
        .ptw-5 {
           padding-top: 50px;
        }
        .lh-40{
            line-height: 40px;
        }
        @media print {
            .p-button {
               display: none;
            }

            .mnh-450 {
                min-height: 650px;
                height: 650px;
            }
            .ptw-5 {
                padding-top: 0;
            }

            .card .card-header h1 {
                line-height: 60px;
            }
        }

        .card .card-header h1 {
            line-height: 45px;
        }
        table tr {
            font-size: 18px;
        }
        table thead tr th {
            text-align: center;
        }

        table tbody tr th {
            text-align: center;
        }

        table tbody tr td:last-child {
            text-align: right;
        }

        .border-bottom-dott {
            border-bottom: 1px dotted #000000;
        }


        .p-button {
            position: absolute;
            right: 15px;
            top: 15px;
            padding: 10px 20px;
        }
    </style>
@endpush

@section('content')

    <div class="card ptw-5" id="printbody">
        <div class="card-header">
            <button class="btn btn-primary p-button" onclick="pfunction()">Print</button>
            <div class="card-title text-center ">
                <h1> বাংলাদেশ পল্লী উন্নয়ন একাডেমি <br> কোটবাড়ী, কুমিল্লা।</h1>
                <br>
                <h3> ব্যয়পূরণ বিলঃ অবধায়ন শাখা</h3>
                <h4 class="text-right pb-3"> স্থায়ী অগ্রিম - ১৫০০০</h4>
            </div>
            <h4>১। পূর্ববর্তী ব্যয়ঃ</h4>
            <h4>২। চলতি ব্যয়ঃ</h4>
            <h4>৩। মোট ব্যয়ঃ</h4>
        </div>
        <div class="card-content ">
            <div class="card-body mnh-450">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 60px">ক্রঃ নং</th>
                                <th style="width: 120px">তারিখ</th>
                                <th style="width: 160px">গাড়ি নম্বর</th>
                                <th>খরচের বিবরণ</th>
                                <th style="width: 140px;">টাকা</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th>০১</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>66511</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td class="text-right pr-3">সর্বমোটঃ</td>
                                <td>9805110</td>
                            </tr>
                            </tbody>

                        </table>
                        <h5 class="mt-3 ml-5 d-flex "><span>কথায়ঃ </span>
                            <span class="w-100 border-bottom-dott ml-1 ">দুই হাজার কোটি টাকা (মাত্র)</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer pt-5 mt-5 border-top-0">
            <div class="row">
                <div class="col-5 text-center"><h5>সেকশন অফিসার (অবধায়ন)</h5></div>
                <div class="col-5 text-center offset-2"><h5>পরিচালক (প্রশাসন)</h5></div>
            </div>
            <h5 class="mt-4 d-flex"><span style="width: 155px">পরিশোধ করুন </span>
                <span class="w-100 border-bottom-dott "></span>
            </h5>
            <h5 class="border-bottom-dott lh-40 d-block mb-5" style="height: 40px"> </h5>
            <br>
            <br>
            <div class="row pt-5">
                <div class="col-4 text-center"><h5>হিসাব রক্ষক</h5></div>
                <div class="col-4 text-center "><h5>হিসাবরক্ষণ কর্মকর্তা</h5></div>
                <div class="col-4 text-center "><h5>পরিচালক (প্রশাসন)</h5></div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script>
        function pfunction() {
            let printContents = document.getElementById("printbody").innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
