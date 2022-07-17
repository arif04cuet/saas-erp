<div class="certificate english">
    <img src="{{ asset('certificates/images/Internal-template.jpg') }}" class="bg-frame" alt="frame-bg.jpg">
    <div class="box">
        <div class="body">
            <p class="text-center text-circle">
                <span>This is to certify that</span>
            </p>
            <p class="text-center ">
                <strong>{{ $trainee['english_name'] ?? trans('labels.not_found')}}</strong>
            </p>
            {{--            <p class="text-center ">--}}
            {{--                <strong>Bangladesh</strong>--}}
            {{--            </p>--}}

            <h3 class="">
                has particapated in the
                "<strong>{{$course->name ?? trans('labels.not_found')}}</strong>"
                held at
                Bangladesh Academy for Rural Development (BARD), Comilla from ({{ $trainee['start_date'] ?? '' }}
                )
                - ({{$trainee['end_date'] ?? '' }})
            </h3>
        </div>
    </div>
    @for($i=0;$i<=8;$i++)
        <br>
    @endfor
</div>
