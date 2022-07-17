@extends('tms::layouts.master')
@section('title', 'Create Training Course Rules and Guidelines')

@section('content')
    <section id="assessment">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">Create Training Course Rules and Guidelines</h4>
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
                            <div class="col-md-6">
                                {{ Form::open(['route' => [
                                        'trainings.courses.objectives.store',
                                        $training->id,
                                        $course->id
                                    ],
                                    'method' => 'POST'
                                ]) }}
                                {{ Form::hidden('training_course_id', $course->id) }}
                                <div class="form-group">
                                    <label for="">Rules and Guidelines</label>
                                    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="">Course Rules & Guideline Key Points</label>
                                    <div class="repeater-default">
                                        <div data-repeater-list="specific_points">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        {{ Form::text('content', null, ['class' => 'form-control']) }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button data-repeater-delete type="button"
                                                                class="btn btn-danger">
                                                            <i class="ft ft-x"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <hr>
                                            </div>
                                        </div>
                                        <div class="form-group overflow-hidden">
                                            <div class="pull-right">
                                                <button type="button" data-repeater-create
                                                        class="btn btn-sm btn-primary">
                                                    <i class="ft-plus"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ft-check-square"></i> {{ trans('labels.save') }}
                                    </button>
                                    <a href="{{ route('trainings.courses.rules-guidelines.show', [$training->id, $course->id]) }}"
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
    </section>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
@endpush