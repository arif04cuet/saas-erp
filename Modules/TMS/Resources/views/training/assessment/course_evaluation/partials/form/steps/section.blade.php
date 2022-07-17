<h6></h6>
<fieldset class="pl-0 pr-0">
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12 pl-0 pr-0">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <div class="form-group row">
                            </div>
                            <div style="text-align: center;">
                                <h3 style="font-weight: 600;">{{ $section->title_en }}</h3>
                            </div>
                            @if($section->subSections->count())
                                @foreach($section->subSections as   $subSection)
                                    @include('tms::training.assessment.course_evaluation.partials.form.steps.sub_section', ['subSection' => $subSection, 'courseObjectives' => $courseObjectives])
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</fieldset>
