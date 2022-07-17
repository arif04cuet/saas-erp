@extends('layouts.result-sheet-master')
@section('title', 'Assign Trainee Course Marks')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="rdcd text-center" style="font-size:24px">পল্লী উন্নয়ন ও সমবায় বিভাগ</h2>
                    {{-- <h3 class="isdp text-center" style="font-size:18px">ইন্টিগ্রেটেড সার্ভিস ডেলিভারি প্ল্যাটফর্ম</h3> --}}
                    <h4 class="card-title text-center">@lang('tms::course.individual_trainee_result_sheet')</h4>
                    <h4 class="card-title text-center pt-2">{{ $training->bangla_title }}</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered training-table" style="font-size:13px;">
                                <thead>
                                    <tr style="background-color: #008000;color:#fff">
                                        <th>@lang('tms::training.trainee_name')</th>
                                        @foreach($course->markAllotments as $markAllotment)
                                            <th>@lang('tms::mark_allotment_type.' . $markAllotment->type->title)</th>
                                        @endforeach
                                        <th>@lang('tms::course.total_number')</th>
                                        <th>@lang('tms::course.letter_grade')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $totalMark = 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $trainee->bangla_name }}</td>
                                        @foreach($achievedMarks as $trainee)
                                        @php
                                         $totalMark = $totalMark + $trainee->value;
                                        //  $totalMark = (int)$trainee->sum('value');
                                        @endphp
                                        <td>
                                            {{-- {{ $markAllotment->mark }} --}}
                                            @if(is_null(optional($trainee)->value))
                                                {{trans('tms::training_course.not_marked') ?? 'Not Marked'}}
                                            @else
                                                @enToBnNumber(optional($trainee)->value ?? 0 )
                                            @endif
                                        </td>
                                        @endforeach
                                        @php
                                            $grade =  Modules\TMS\HTTP\Controllers\TraineeCourseMarkValueController::getCourseGradingInfo($course,$totalMark);
                                        @endphp
                                        <td>{{ $totalMark }}</td>
                                        <td>{{ isset($grade) ? $grade : '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

    window.onload = function () {
        window.print();
    }

</script>
