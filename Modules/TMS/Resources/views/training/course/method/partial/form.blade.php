@php
    $commonHtmlAttributes = [
        'class' => 'form-control',
        'required',
        'data-rule-required',
        'data-msg-required' => trans('labels.This field is required')
    ];
    $titleCollectiveArguments = array_merge(
            $commonHtmlAttributes,
           [
               'data-rule-maxlength' => 500,
               'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>500])
           ]
        );
    $descriptionCollectiveArguments = array_merge(
            $commonHtmlAttributes,
            [
                'data-rule-maxlength' => 20000,
                'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>20000])
            ]
        );
@endphp

{{ Form::hidden('training_course_id', $course->id) }}
<div class="form-group">
    <label for="">Methods and Technologies</label>
    <div class="repeater-custom">
        <div data-repeater-list="methods_and_strategies">
            @if(old('methods_and_strategies'))
                @foreach(old('methods_and_strategies') as $oldInput)
                    <div data-repeater-item>
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    {{ Form::text('title', $oldInput['title'],
                                        $titleCollectiveArguments
                                    ) }}

                                    @error(['key' => 'methods_and_strategies.' . $loop->index . '.title'])@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    {{ Form::textarea('description', $oldInput['description'],
                                        $descriptionCollectiveArguments
                                    ) }}

                                    @error(['key' => 'methods_and_strategies.' . $loop->index . '.description'])
                                    @enderror
                                </div>
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
                @if($course->methods->count())
                    @foreach($course->methods as $method)
                        <div data-repeater-item>
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        {{ Form::text('title', isset($method) ? $method->title : null,
                                            $titleCollectiveArguments
                                        ) }}

                                        @error(['key' => 'methods_and_strategies.' . $loop->index . '.title'])@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        {{ Form::textarea('description', isset($method) ? $method->description : null,
                                            $descriptionCollectiveArguments
                                        ) }}

                                        @error(['key' => 'methods_and_strategies.' . $loop->index .
                                        '.description'])@enderror
                                    </div>
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
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    {{ Form::text('title', null,
                                        $titleCollectiveArguments
                                    ) }}
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    {{ Form::textarea('description', null,
                                        $descriptionCollectiveArguments
                                    ) }}
                                </div>
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
