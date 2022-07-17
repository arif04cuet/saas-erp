<?php

    namespace Modules\TMS\Entities;

    use Illuminate\Database\Eloquent\Model;

    class AssessmentQuestionType extends Model
    {
        protected $fillable = ['name'];

        public function assessmentQuestions()
        {
            return $this->hasMany(AssessmentQuestion::class, 'assessment_question_type_id');
        }





    }
