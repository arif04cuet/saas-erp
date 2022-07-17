@extends('tms::trainee.certificate.layout')

@section('head_style')
    @include('tms::trainee.certificate.partials.inline-style-international')

    <title>@lang('tms::trainee.bengali_certificate')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pinyon+Script&display=swap" rel="stylesheet">
@endsection

@section('content')
    @foreach($data as $trainee)
        <div class="certificate english">
            <img src="{{ asset('certificates/images/Internal-template.jpg') }}" class="bg-frame" alt="frame-bg.jpg">
            <div class="box">
                <div class="body">
                    <p class="text-center text-circle">
                        <span>This is to certify that</span>
                    </p>
                    <p class="text-center ">
                        <strong>{{ $trainee->english_name ?? trans('labels.not_found')}}</strong>
                    </p>
                    {{--                <p class="text-center ">--}}
                    {{--                    <strong>Bangladesh</strong>--}}
                    {{--                </p>--}}

                    <h3 class="">
                        has particapated in the
                        "<strong>{{$trainee->course_name ?? trans('labels.not_found')}}</strong>"
                        held at
                        Rural Development and Cooperative Division (RDCD), Comilla
                        from ({{$trainee->training_start_date ?? '' }})
                        - ({{$trainee->training_end_date ?? '' }})
                    </h3>
                </div>
            </div>
        </div>
        @for($i=0;$i<=8;$i++)
            <br>
        @endfor
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

<script>

    window.onload = function () {
        window.print();
    }

</script>

