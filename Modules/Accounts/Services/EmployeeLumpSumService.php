<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\EnToBnNumberConverter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\Accounts\Repositories\EmployeeLumpSumRepository;
use PhpOffice\PhpWord\TemplateProcessor;

class EmployeeLumpSumService
{
    use CrudTrait;
    use FileTrait;
    private $employeeLumpSumRepository;

    public function __construct(EmployeeLumpSumRepository $employeeLumpSumRepository)
    {
        $this->setActionRepository($employeeLumpSumRepository);
    }

    public function generateDoc($lumpSumId, $configuration)
    {
        $lumpsum = $this->findOne($lumpSumId);
        if (!$lumpsum) {
            Session::flash('error', 'Lump Sum Record not found');
            return;
        }
        $pensionContract = $lumpsum->pensionContracts->filter(function ($item) {
            return $item->status == 'active';
        })->first();
        $employee = $lumpsum->employee;
        $template = storage_path() . '/files/templates/lumpsum-bill-template.docx';
        $templateProcessor = new TemplateProcessor($template);
        $templateData = $this->prepareBillData($employee, $pensionContract, $lumpsum, $configuration);
        foreach ($templateData as $key => $templateDatum) {
            $templateProcessor->setValue($key, $templateDatum);
        }
        $fileName = $employee->employee_id . '_lump_sum_bill.docx';
        $filePath = storage_path() . '/files/temps/' . $fileName;
        $templateProcessor->saveAs($filePath);
        header("Content-disposition: attachment;filename=" . $fileName . " ; charset=iso-8859-1");
        echo file_get_contents($filePath);
    }

    /**
     * Preparing data to make it compatible with the template processor
     * @param $employee
     * @param $pensionContract
     * @param $lumpsum
     * @param $configuration
     * @return array
     */
    private function prepareBillData($employee, $pensionContract, $lumpsum, $configuration)
    {
        $lumpsumTotal = $lumpsum->monthly_pension * $configuration->lump_sum_number;
        $templateValues = [
            'name' => $employee->getName(),
            'fatherName' => $employee->employeePersnalInfo->father_name ?? " ",
            'postOffice' => " ",
            'ps' => " ",
            'village' => " ",
            'district' => " ",
            'ppoNo' => EnToBnNumberConverter::en2bn($pensionContract->ppo_number, false),
            'lumpSum' => EnToBnNumberConverter::en2bn($lumpsum->monthly_pension, true, 2),
            'lumpSumTotal' => EnToBnNumberConverter::en2bn($lumpsumTotal, true, 2)
        ];
        /**
         * Fetching and calculating deduction which will be adjusted with total lump sum amount
         */
        $deductions = optional($lumpsum)->deductions;
        $totalDeduction = 0;

        for ($i = 0; $i <= 3; $i++) {
            $templateValues['deduction' . $i] = "";
            $templateValues['amount' . $i] = "";
        }

        $lang = App::getLocale();
        foreach ($deductions as $key => $deduction) {
            $deductionName = $lang == 'bn' ? optional($deduction->pensionDeduction)->bangla_name :
                optional($deduction->pensionDeduction)->name;
            $totalDeduction += $deduction->amount;
            $templateValues['deduction' . $key] = $deductionName;
            $templateValues['amount' . $key] = EnToBnNumberConverter::en2bn($deduction->amount);
        }

        $templateValues['totalDeduct'] = EnToBnNumberConverter::en2bn($totalDeduction, true, 2);
        $templateValues['nitAmount'] = EnToBnNumberConverter::en2bn($lumpsumTotal - $totalDeduction, true, 2);
        $templateValues['nitAmountInWord'] =
            EnToBnNumberConverter::numberToBanglaWords($lumpsumTotal - $totalDeduction);

        return $templateValues;
    }
}

