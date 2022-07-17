@extends('tms::trainee.certificate.layout')

@section('head_style')
    @include('tms::trainee.certificate.partials.inline-style-bn')

    <title>@lang('tms::trainee.bengali_certificate')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pinyon+Script&display=swap" rel="stylesheet">
@endsection

@section('content')
    @foreach($data as $trainee)
        <div class="certificate english">
            <img src="{{ asset('certificates/images/fream-bg.jpg') }}" class="bg-frame" alt="frame-bg.jpg">
            <div class="box">
                <div class="top d-flex">
                    <div class="left">
                        <img class=logo src="{{ asset('certificates/images/govtbd-logo.png') }}">
                    </div>
                    <div class="middle">
                        <h1>পল্লী উন্নয়ন ও সমবায় বিভাগ</h1>
                        {{-- <h3>ইন্টিগ্রেটেড সার্ভিস ডেলিভারি প্ল্যাটফর্ম</h3> --}}
                    </div>
                    <div class="right">
                        <img class=logo src="{{ asset('certificates/images/logo.png') }}">
                    </div>
                </div>
                <div class="top two ">
                    <div class="left">
                        <p>ক্রমিক নং {{ time() }}</p>
                    </div>
                    <div class="middle">
                        <img src="{{ asset('certificates/images/logotext1.jpg') }}" alt="">
                    </div>
                    <div class="right">
                        <p style="margin-top: 30px">
                            তারিখ :
                            <span class="bd-b-1 mini-width d-inline-block" style="line-height: 1.2">
                        {{ $current_date ?? '' }}
                        </span>
                        </p>
                    </div>
                </div>
                <div class="body">
                    <p>
                        <span>এই মর্মে প্রত্যয়ন করা যাচ্ছে যে</span>
                        {{ $trainee->name_bangla }}
                    </p>
                    <p>
                        <span>পিতা/স্বামীর নাম:</span>
                        <b class="w-280 d-inline-block">{{ $trainee->father_name_bangla ?? '' }}</b>
                        <span class="pl-2 pr-2">মাতার নাম: </span>{{ $trainee->mother_name_bangla ?? '' }}
                    </p>
                    <p>
                        <span>পদবী:</span>
                        <b class="w-350 d-inline-block">{{ $trainee->designation_bangla ?? ''  }}</b>
                        <span class="pl-2 pr-2">বর্তমান ঠিকানা:</span>{{ $trainee->present_address_bangla }}
                    </p>
                    <p>
                        <b class="w-400 d-inline-block"> <!-- ঢাকা ১২১২ --></b>
                        <span class="pl-2">প্রতিষ্ঠানের নাম:</span>
                        {{ $trainee->sponsors  ?? ''}}
                    </p>
                    <p>
                        <span
                            class="pb-2">পল্লী উন্নয়ন ও সমবায় বিভাগ কর্তৃক পরিচালিত</span>
                        <br>
                        {{ $course->name_bangla }}
                    </p>
                    <p>
                        <b class="w-280 d-inline-block"><!-- তথ্য --> </b>
                        <span>বিষয়ক প্রশিক্ষণ কোর্স </span>
                        <b class="w-140 d-inline-block">{{ $trainee->training_start_date ?? '' }}</b>
                        <span>হতে</span>
                        <b>{{ $trainee->training_end_date ?? '' }}</b>
                        <span class="pl-2 float-right">পর্যন্ত </span>
                    </p>
                    <p class="border-0"><span>সাফল্যের সাথে সম্পন্ন করেছেন।</span></p>
                </div>
                <div class="footer">
                    <div class="row">
                        <div class="col-4 text-center">
                    <span>
                        কোর্স পরিচালক
                    </span>
                        </div>
                        <div class="col-4 text-center">
                    <span>
                        পরিচালক (প্রশিক্ষণ)
                    </span>
                        </div>
                        <div class="col-4 text-center">
                    <span>
                        মহাপরিচালক
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('page-css')
    <style type="text/css">
        .ddddd::after {
            content: '';
            margin: 10px;
        }
    </style>
@endpush
