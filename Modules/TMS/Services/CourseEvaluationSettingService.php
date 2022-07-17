<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\CourseEvaluationOption;
use Modules\TMS\Entities\CourseEvaluationQuestionnaire;
use Modules\TMS\Entities\CourseEvaluationSection;
use Modules\TMS\Entities\CourseEvaluationSubSection;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\CourseEvaluationSettingRepository;

class CourseEvaluationSettingService
{
    use CrudTrait;

    private $repository;
    private $dates;
    private $dateFormat;

    private $sections;
    private $subSections;
    private $questionnaires;
    private $options;

    public function __construct(
        CourseEvaluationSettingRepository $courseEvaluationSettingRepository
    )
    {
        $this->repository = $courseEvaluationSettingRepository;
        $this->setActionRepository($this->repository);

        $this->dates = ['start_date', 'end_date'];
        $this->dateFormat = 'd/m/Y';

        $this->sections = config('course_evaluation.section');
        $this->subSections = config('course_evaluation.sub_section');
        $this->questionnaires = config('course_evaluation.questionnaire');
        $this->options = config('course_evaluation.option');
    }

    public function activeCourses()
    {
        return $this->repository->findBy([
            'status' => 1
        ]);
    }

    public function setting(TrainingCourse $trainingCourse)
    {
        return $this->repository->findBy([
            'training_course_id' => $trainingCourse->id
        ])->first();
    }

    public function storeUpdate(TrainingCourse $trainingCourse, $data = [])
    {
        return DB::transaction(function () use ($trainingCourse, $data) {
            $setting = $this->repository->findBy([
                'training_course_id' => $trainingCourse->id
            ])->first();

            $data = $this->format($data);
            if(is_null($setting)) {
                $data['training_course_id'] = $trainingCourse->id;
                if($data['status']) {
                    $setting = $this->repository->save($data);
                    $this->setCourseEvaluation($trainingCourse);
                }
            }else {
                $setting = $this->repository->update($setting, $data);
            }
            return $setting;
        });
    }

    private function format($data = [])
    {
        foreach($this->dates as $date) {
            if(isset($data[$date])) {
                $data[$date] = Carbon::createFromFormat($this->dateFormat, $data[$date]);
            }
        }

        if(!isset($data['status'])) {
            $data['status'] = false;
        }

        return $data;
    }

    private function setCourseEvaluation(TrainingCourse $trainingCourse)
    {
        //TODO: Create Course Evaluation sections, sub sections, questionnaires, options

        //dd($this->sections, $this->subSections, $this->questionnaires, $this->options);

       foreach ($this->sections as $sectionKey => $section) {
           $section['training_course_id'] = $trainingCourse->id;
           $newSection = $this->createSection($section);
           $this->createSubSection($newSection, $sectionKey);
       }
    }

    private function createSection($section)
    {
        return CourseEvaluationSection::create($section);
    }

    private function createSubSection($section, $index = 0) {
        $filteredSubSections = $this->filterSubSection($index);

        foreach ($filteredSubSections as $subSectionKey => $subSection) {
            $newSubSection = CourseEvaluationSubSection::create([
                'title_en' => $subSection['title_en'],
                'title_bn' => $subSection['title_bn'],
                'label_en' => $subSection['label_en'],
                'label_bn' => $subSection['label_bn'],
                'objective_en' => $subSection['objective_en'],
                'objective_bn' => $subSection['objective_bn'],
                'is_option_enabled' => $subSection['is_option_enabled'],
                'course_evaluation_section_id' => $section->id,
            ]);

            $this->createQuestionnaire($newSubSection, $subSectionKey);
            $this->createOption($newSubSection, $subSectionKey);
        }
    }

    private function createQuestionnaire($subSection, $index = 0)
    {
        $filteredQuestionnaires = $this->filterQuestionnaire($index);

        foreach ($filteredQuestionnaires as $questionnaireKey => $questionnaire) {
            $newQuestionnaire = CourseEvaluationQuestionnaire::create([
                'title_en' => $questionnaire['title_en'],
                'title_bn' => $questionnaire['title_bn'],
                'is_optional' => $questionnaire['is_optional'],
                'type' => $questionnaire['type'],
                'course_evaluation_sub_section_id' => $subSection->id,
            ]);
        }
    }

    private function createOption($subSection, $index)
    {
        $filteredOptions = $this->filterOption($index);

        foreach ($filteredOptions as $optionKey => $option) {
            $newOption = CourseEvaluationOption::create([
                'title_en' => $option['title_en'],
                'title_bn' => $option['title_bn'],
                'mark' => $option['mark'],
                'course_evaluation_sub_section_id' => $subSection->id,
            ]);
        }
    }

    private function filterSubSection($index)
    {
        return array_filter(
            $this->subSections,
            function ($section) use($index){
                return $section['section_index'] == $index;
            }
        );
    }

    private function filterQuestionnaire($index)
    {
        return array_filter(
            $this->questionnaires,
            function ($questionnaire) use($index) {
                return $questionnaire['sub_section_index'] == $index;
            }
        );
    }

    private function filterOption($index)
    {
        return array_filter(
            $this->options,
            function ($option) use($index) {
                return $option['sub_section_index'] == $index;
            }
        );
    }

}
