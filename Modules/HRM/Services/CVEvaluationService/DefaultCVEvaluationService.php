<?php
/**
 * CVEvaluationService
 *
 * Evaluate a job application based on rules set for a specific job circular
 *
 */

namespace Modules\HRM\Services\CVEvaluationService;

use App\Entities\JobApplication;
use Carbon\Carbon;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Entities\JobCircularQualificationRule;

/**
 * Class DefaultCVEvaluationService
 * @package Modules\HRM\Services\CVEvaluationService
 */
class DefaultCVEvaluationService
{
    /**
     * @var JobCircular
     */
    private $jobCircular;

    /**
     * @var JobApplication
     */
    private $jobApplication;

    /**
     * @var JobCircularQualificationRule
     */
    private $jobCircularQualificationRule;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $rules;

    /**
     * @var bool
     */
    public $shortListed;

    /**
     * DefaultCVEvaluationService constructor.
     * @param JobCircular $jobCircular
     * @param JobApplication $jobApplication
     * @param JobCircularQualificationRule $jobCircularQualificationRule
     */
    public function __construct(
        JobCircular $jobCircular,
        JobApplication $jobApplication,
        JobCircularQualificationRule $jobCircularQualificationRule
    )
    {
        $this->jobCircular = $jobCircular;
        $this->jobApplication = $jobApplication;
        $this->jobCircularQualificationRule = $jobCircularQualificationRule;

        $this->shortListed = true;

        $this->rules = config('cv-evaluation-rules');

        return $this->rules()->properties();
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        if($this->shortListed) {
            call_user_func_array(array($this, $name), $arguments);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function evaluate()
    {
        $this->__call('evaluateExamResults', ['>='])
            ->__call('evaluateExamYears', ['>='])
            ->__call('evaluateAge', [])
            ->__call('evaluateGender', []);

        return $this;
    }

    /**
     * @return $this
     */
    private function rules()
    {
        foreach($this->jobCircularQualificationRule->getFillable() as $key => $property) {
            if(isset($this->jobCircularQualificationRule->$property)) {
                $this->setRules($property);
            }
        }

        return $this;
    }

    /**
     * @param $property
     */
    private function setRules($property)
    {
        switch($property) {
            case 'min_ssc_year':
                $this->rules['exams']['ssc']['rules']['year'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'min_hsc_year':
                $this->rules['exams']['hsc']['rules']['year'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'min_grad_year':
                $this->rules['exams']['graduation']['rules']['year'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'min_post_grad_year':
                $this->rules['exams']['post_graduation']['rules']['year'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'ssc_point':
                $this->rules['exams']['ssc']['rules']['point'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'hsc_point':
                $this->rules['exams']['hsc']['rules']['point'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'grad_point':
                $this->rules['exams']['graduation']['rules']['point'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'post_grad_point':
                $this->rules['exams']['post_graduation']['rules']['point'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'gender':
                $this->rules['gender']['rules'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'upper_age_limit':
                $this->rules['age']['upper_limit']['rules'] = $this->jobCircularQualificationRule->$property;
                break;
            case 'lower_age_limit':
                $this->rules['age']['lower_limit']['rules'] = $this->jobCircularQualificationRule->$property;
                break;
            default:
                break;
        }
    }

    /**
     * @return DefaultCVEvaluationService
     */
    private function properties()
    {
        return $this->setExamProperties()->setGenderProperties()->setAgeProperties();
    }

    /**
     * @return $this
     */
    private function setExamProperties()
    {
        $this->jobApplication->educations()
            ->get()
            ->each(function ($education) {
                if(isset($education->exam_name)) {
                    foreach ($this->rules['exams'] as $key => $exam) {
                        if(in_array(strtolower($education->exam_name), $exam['aliases'])) {
                            if(isset($education->grade)) {
                                $this->rules['exams'][$key]['properties']['point'] = $education->grade;
                            }
                            if(isset($education->passing_year)) {
                                $this->rules['exams'][$key]['properties']['year'] = $education->passing_year;
                            }
                        }
                    }
                }
            });

        return $this;
    }

    /**
     * @return $this
     */
    private function setGenderProperties()
    {
        if(isset($this->jobApplication->gender)) {
            $this->rules['gender']['properties'] = strtolower($this->jobApplication->gender);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setAgeProperties()
    {
        if(isset($this->jobApplication->birth_date)) {
            $this->rules['age']['properties'] = $this->jobApplication->birth_date;
        }

        return $this;
    }

    /**
     * @param $operator
     * @return $this
     */
    private function evaluateExamResults($operator)
    {
        foreach ($this->rules['exams'] as $key => $exam) {
            if(isset($exam['rules'])) {
                if(isset($exam['rules']['point'])) {
                    if($this->compare($exam['properties']['point'] ?? null, $exam['rules']['point'], $operator) === false) {
                        $this->shortListed = false;
                        break;
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @param $operator
     * @return $this
     */
    private function evaluateExamYears($operator)
    {
        foreach ($this->rules['exams'] as $key => $exam) {
            if(isset($exam['rules'])) {
                if(isset($exam['rules']['year'])) {
                    if($this->compare($exam['properties']['year'] ?? null, $exam['rules']['year'], $operator) === false) {
                        $this->shortListed = false;
                        break;
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function evaluateAge()
    {
        if(isset($this->rules['age'])) {
            if(isset($this->rules['age']['upper_limit'])) {
                if(isset($this->rules['age']['upper_limit']['rules'])) {
                    if(isset($this->rules['age']['properties'])) {
                        if($this->compare(Carbon::parse($this->rules['age']['properties'])->age, $this->rules['age']['upper_limit']['rules'], '>')) {
                            $this->shortListed = false;
                            return $this;
                        }
                    }
                }

                if(isset($this->rules['age']['lower_limit']['rules'])) {
                    if(isset($this->rules['age']['properties'])) {
                        if($this->compare(Carbon::parse($this->rules['age']['properties'])->age, $this->rules['age']['lower_limit']['rules'], '<')) {
                            $this->shortListed = false;
                            return $this;
                        }
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function evaluateGender()
    {
        if(isset($this->rules['gender'])) {
            if(isset($this->rules['gender']['rules'])) {
                if(isset($this->rules['gender']['properties'])) {
                    $this->shortListed = $this->rules['gender']['properties'] == $this->rules['gender']['rules'];
                }
            }
        }

        return $this;
    }

    /**
     * @param $a
     * @param $b
     * @param $operator
     * @return bool
     */
    private function compare($a, $b, $operator)
    {
        switch ($operator) {
            case '==':
                return doubleval($a) == doubleval($b);
                break;
            case '>':
                return doubleval($a) > doubleval($b);
                break;
            case '>=':
                return doubleval($a) >= doubleval($b);
                break;
            case '<':
                return doubleval($a) < doubleval($b);
                break;
            case '<=':
                return doubleval($a) <= doubleval($b);
                break;
            case '!=':
                return doubleval($a) != doubleval($b);
                break;
            default:
                return false;
        }
    }

}
