<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    protected $fillable = ['name'];

    public function assessmentQuestionType()
    {
        return $this->hasOne(AssessmentQuestionType::class, 'id', 'assessment_question_type_id');
    }
}
