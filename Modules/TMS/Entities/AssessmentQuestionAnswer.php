<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestionAnswer extends Model
{
    protected $fillable = ['training_speaker_assessment_id', 'assessment_question_id', 'value'];
}
