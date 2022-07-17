<h6></h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="text-md-center mt-1 mt-md-4">
                    <h2 style="font-weight: 600;  " class="text-title">Rural Development & Co-operative Division</h2>
                </div>
                <div class="mt-1 mt-md-3">
                    <p style="font-size: 18px; font-weight: 400; text-align: left;">
                        Thank you for attending the <b>{{$course->training->title}}</b>. Your feedback as a participant is crucial for RDCD to ensure that we are meeting your training needs. Your feedback also allows us to continually adapt training to better suit needs of the future trainees. We would appreciate if you could take a few minutes filling in this evaluation form. Your feedback will be treated in the strictest of confidence.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 plr-xs-0">
            <div class="card-body">
                {{ Form::hidden('training_course_id', $course->id) }}
                <h4 class="form-section">
                    <i class="la la-table"></i>
                    <b>General Information</b>
                </h4>
                <div class="form-group row">
                    <label for="course_name"
                           class="label-control col-md-3 col-lg-2">
                        Course Name
                    </label>
                    <div class="col-md-9 col-lg-10">
                        {{ Form::text(null, $course->training->title, [
                            'class' => 'form-control',
                            'disabled'
                        ]) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('date', 'Date',
                    ['class' => 'col-md-3 col-lg-2 label-control']) }}
                    <div class="col-md-9 col-lg-10">
                        {{ Form::text(null, date('j F, Y'), ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
