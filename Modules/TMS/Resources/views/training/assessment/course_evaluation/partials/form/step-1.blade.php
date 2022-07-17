<h6></h6>
<fieldset>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group text-center">
                    <h2>
                        Bangladesh Academy for Rural Development (BARD)
                        Kotbari, Comilla
                    </h2>
                </div>

                <div>
                    <h3>COURSE EVALUATION : </h3>

                    <p>
                        Thank you for attending the 64th Foundation Training Course. Your feedback as a participant is crucial for BARD to ensure that we are meeting your training needs. Your feedback also allows us to continually adapt training to better suit needs of the future trainees. We would appreciate if you could take a few minutes filling in this evaluation form. Your feedback will be treated in the strictest of confidence
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card-body">
                {{ Form::hidden('training_course_id', $course->id) }}

                <h4 class="form-section"><i
                            class="la la-table"></i>@lang('tms::training.evaluation.general_info_title')
                </h4>

                <div class="form-group row">
                    <label for="course_name"
                           class="required label-control col-md-3">
                        @lang('tms::training.evaluation.course_name')
                    </label>
                    <div class="col-md-9">
                        {{ Form::text(null, $course->name, [
                            'class' => 'form-control',
                            'disabled'
                        ]) }}
                    </div>
                </div>


                <!-- Date -->
                <div class="form-group row">
                    {{ Form::label('date', trans('labels.date'),
                    ['class' => 'col-md-3 label-control required']) }}
                    <div class="col-md-9">
                        {{ Form::text(null, date('j F, Y'), ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</fieldset>
