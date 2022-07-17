<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 10/21/18
 * Time: 3:17 PM
 */

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\SalaryBasic;
use Modules\Accounts\Repositories\PayscaleRepository;

class PayscaleService
{
    use CrudTrait;

    protected $payscaleRepository;

    /**
     * PayscaleService constructor.
     * @param PayscaleRepository $payscaleRepository
     */
    public function __construct(PayscaleRepository $payscaleRepository)
    {
        $this->payscaleRepository = $payscaleRepository;
        $this->setActionRepository($payscaleRepository);
    }

    /**
     * @return Model
     */
    public function getActivePayscale()
    {
        return $this->findBy(['status' => 1])->first();
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveData($data)
    {
        $data['active_from'] = date('Y-m-d', strtotime($data['active_from']));
        //dd($data);
        $savePayscale = $this->save($data);

        // Saving salary basics for the particular payscale
        foreach ($data['basic'] as $key => $basic) {
            $salaryBasic = new SalaryBasic;

            $salaryBasic->payscale_id = $savePayscale->id;
            $salaryBasic->grade = $key + 1;
            $salaryBasic->basic_salary = $basic;
            $salaryBasic->percentage_of_increment = $data['increment'][$key];
            $salaryBasic->no_of_increment = $data['no_of_increment'][$key];

            $salaryBasic->save();
        }
        return $savePayscale;
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateData($data, $id)
    {
        $payscale = $this->findOne($id);
        $salaryBasics = (!is_null($payscale)) ? $payscale->salaryBasics : [];
        $updatingData = [
            'title' => $data['title'],
            'active_from' => date('Y-m-d', strtotime($data['active_from'])),
        ];
        $this->update($payscale, $updatingData);
        foreach ($salaryBasics as $basic) {
            $updateSalaryData = [
                'basic_salary' => $data['basic'][$basic->grade - 1],
                'percentage_of_increment' => $data['increment'][$basic->grade - 1],
                'no_of_increment' => $data['no_of_increment'][$basic->grade - 1],
            ];
            SalaryBasic::where('id', $basic->id)->update($updateSalaryData);
        }
    }

    /**
     * @param $payscaleId
     */
    public function toggleActivation($payscaleId)
    {
        $payscale = $this->findOrFail($payscaleId);
        if ($payscale->status) {
            $payscale->update(['status' => 0]);
        } else {
            $activePayscale = $this->getActivePayscale();
            if (!is_null($activePayscale)) {
                $this->update($activePayscale, ['status' => 0]);
            }
            $this->update($payscale, ['status' => 1]);
        }
    }

    /**
     * @param int $grade
     * @param int $increment
     * @return float|int|mixed
     */
    public function getBasicSalary($grade = 9, $increment = 0)
    {
        $activePayscale = $this->getActivePayscale();
        $basics = (!is_null($activePayscale)) ? $activePayscale->salaryBasics : [];
        $basicSalary = 0;
        $percentage = 5;
        $maxIncrement = $increment;
        foreach ($basics as $basic) {
            if ($basic->grade == $grade) {
                $basicSalary = $basic->basic_salary;
                $maxIncrement = $basic->no_of_increment;
                $percentage = $basic->percentage_of_increment;
            }
        }
        if ($increment && $increment <= $maxIncrement) {
            for ($count = 1; $count <= $increment; $count++) {
                $basicSalary += (($basicSalary * $percentage) / 100);
                $basicSalary = $this->roundUpBasic($basicSalary);
            }
        }

        return $basicSalary;
    }

    public function salaryMaxIncrement($grade)
    {
        $activePayscale = $this->getActivePayscale();
        return SalaryBasic::where('payscale_id', $activePayscale->id)
            ->where('grade', $grade)
            ->pluck('no_of_increment')
            ->first();
    }

    public function roundUpBasic($basic)
    {
        return round(ceil(($basic) / 10)) * 10;
    }

    public function getSalaryBasics()
    {
        $activePayscale = $this->getActivePayscale();
        $basics = $activePayscale->salaryBasics ?? [];
        return $basics;
    }


    public function getSalaryBasicsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $salaryBasics = $query ? $this->actionRepository->findBy($query) : $this->getSalaryBasics();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $salaryBasics,
            $implementedKey,
            $implementedValue ?: function ($grade) {
                return "Grade " . $grade->grade;
            },
            $isEmptyOption
        );
    }

    public function nextApplicableIncrement($salaryGrade, $increment)
    {
        $maxIncrement = $this->salaryMaxIncrement($salaryGrade);
        return ($increment < $maxIncrement) ? $increment + 1 : $maxIncrement;
    }

}
