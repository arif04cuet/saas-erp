@extends('tms::training.certificate.layout')

@section('head_style')
    <title>{{ $course->name }}</title>
    <link href="https://fonts.googleapis.com/css?family=Cinzel:700|Norican|Playfair+Display:400,400i&display=swap"
          rel="stylesheet">
    <style type="text/css">
        @media print {
            @page {
                margin: 0;
            }
        }

        body {
            padding: 0;
            margin: 0;
        }

        .page svg {
            width: 100% !important;
            max-height: 100%;
        }

        @media print {
            .break {
                page-break-after: always;
            }
        }

        .page.break {
            overflow: hidden;
            margin: -7px 0 0 0;
            padding-top: 5px;
        }
    </style>
    @if($level == 'international')
        @include('tms::trainee.certificate.partials.inline-style-international')
    @endif
@endsection

@section('content')
    @if($data->count())
        @foreach($data as $trainee)
            @if($level == 'international')
                @include('tms::training.certificate.partials.international', ['trainee' => $trainee, 'course' => $course])
            @else
                @include('tms::training.certificate.partials.template', ['trainee' => $trainee, 'course' => $course])
            @endif
            <div class="page-break-always"></div>
        @endforeach
    @endif
@endsection

<script>

    window.onload = function () {
        window.print();
    }

</script>
