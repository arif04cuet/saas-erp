@extends('tms::layouts.master')
@section('title', 'Assign Trainee Course Marks')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="repeat-form">Assign Trainee Course Marks</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::open(['route' => ['trainees.courses.marks.values.update', $training->id, $course->id],
                                    'method' => 'PUT'
                                ]) }}
                                {{ Form::hidden('trainee_id', $trainee->id) }}
                                @foreach($course->markAllotments as $markAllotment)
                                    <div class="form-group">
                                        <label>
                                            @lang('tms::mark_allotment_type.' . $markAllotment->type->title)
                                        </label>
                                        @php
                                            $assignedMark = $achievedMarks->where('mark_allotment_type_id', $markAllotment->type->id)->first();
                                        @endphp
                                        {{ Form::hidden("marks[$loop->index][mark_allotment_id]", $markAllotment->id) }}
                                        {{ Form::hidden("marks[$loop->index][mark_allotment_type_id]", $markAllotment->type->id) }}
                                        {{ Form::number("marks[$loop->index][value]",
                                            is_null($assignedMark) ? null : $assignedMark->value,
                                            [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'max' => $markAllotment->mark,
                                                'required'
                                            ]
                                        ) }}

                                        @error(['key' => 'marks.' . $loop->index . '.value'])@enderror
                                    </div>
                                @endforeach

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ft-check-square"></i> {{ trans('labels.save') }}
                                    </button>
                                    <a href="{{ route('trainees.courses.marks.values.show', [$training->id, $course->id]) }}"
                                       class="btn btn-warning">
                                        <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                    </a>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
