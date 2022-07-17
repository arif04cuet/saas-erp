@php
    $specificPointCollectiveArguments = [
        'class' => 'form-control',
        'required',
        'data-msg-required' => trans('labels.This field is required'),
        'data-rule-maxlength' => 500,
        'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>500])
    ];
@endphp

{{ Form::hidden('training_course_id', $course->id) }}
<div class="form-group">
    <label for="">Rules and Guidelines</label>
    {{ Form::textarea('description', isset($description) ? $description : null,
        [
            'class' => 'form-control',
            'required',
            'data-msg-required' => trans('labels.This field is required'),
            'data-rule-maxlength' => 20000,
            'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>20000])
        ]
    ) }}

    @error(['key' => 'description'])@enderror
</div>
<hr>
<div class="form-group">
    <label for="">Course Rules & Guideline Key Points</label>
    <div class="repeater-custom">
        <div data-repeater-list="specific_points">
            @if(old('specific_points'))
                @foreach(old('specific_points') as $oldInput)
                    <div data-repeater-item>
                        <div class="row">
                            <div class="col-md-10">
                                {{ Form::text('content', $oldInput['content'], $specificPointCollectiveArguments) }}

                                @error(['key' => "specific_points.$loop->index.content"])@enderror
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
                @endforeach
            @else
                @if($specificPoints->count())
                    @foreach($specificPoints as $specificPoint)
                        <div data-repeater-item>
                            <div class="row">
                                <div class="col-md-10">
                                    {{ Form::text('content', $specificPoint->content, $specificPointCollectiveArguments) }}
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
                    @endforeach
                @else
                    <div data-repeater-item>
                        <div class="row">
                            <div class="col-md-10">
                                {{ Form::text('content', null, $specificPointCollectiveArguments) }}
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
                @endif
            @endif
        </div>
        <div class="form-group overflow-hidden">
            <div class="pull-right">
                <button type="button" data-repeater-create
                        class="btn btn-sm btn-primary">
                    <i class="ft-plus"></i> @lang('labels.add')
                </button>
            </div>
        </div>
    </div>
</div>

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('js/jquery-repeater/custom.js') }}"></script>
    <script src="{{ asset('js/jquery-validator-init.js') }}"></script>
@endpush
