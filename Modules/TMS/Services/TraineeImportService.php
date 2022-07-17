<?php

namespace Modules\TMS\Services;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Utilities\EnToBnNumberConverter;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TraineeImportService
{
    private $traineeService;
    private $traineeList = [];
    private $errorList = [];
    private $brokenTraineeMobileList = [];

    public function __construct(TraineeService $traineeService)
    {
        $this->traineeService = $traineeService;
    }

    /**
     * @return mixed
     */
    public function createSampleFile()
    {
        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(function () {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($this->getSampleData());
            $this->setColumnWidthToAuto($spreadsheet);
            $this->writeAndDownload($spreadsheet);
        });

        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="Sample File.xlsx"');
        return $streamedResponse->send();
    }

    /**
     * If everything found ok, traineeList will be set with real data
     * @param Request $data
     * @param Training $training
     * @return array
     */
    public function checkForErrors(Request $data, Training $training): array
    {
        $errorList = [];

        // validate uploaded file
        $errorList[] = $this->validateFile($data);

        // if file validation failed, dont go further
        if (count(array_filter($errorList))) {
            $this->errorList = array_filter($errorList);
            return $this->errorList;
        }

        // check for uploaded file header format
        $errorList[] = $this->validateFileHeaderFormat($data, $training);

        // check for max allowed trainee number
        $errorList[] = $this->checkForOverFlow($this->traineeList, $training);

        // set the errorList
        $this->errorList = array_filter($errorList);

        return $this->errorList;
    }

    /**
     * @param Training $training
     * @return string
     */
    public function getMaxTraineeUploadMessage(Training $training): string
    {
        $registeredTraineeNumber = $this->getRegisteredTraineeNumber($training);
        $allowedNumberOfTrainees = $training->no_of_trainee - $registeredTraineeNumber;
        $message = trans('tms::training.fileUploadMassage');
        if (!app()->isLocale('bn')) {
            return $numberOfTraineeCanBeInFile = $message . ' ' . EnToBnNumberConverter::en2bn($allowedNumberOfTrainees);
        } else {
            return $numberOfTraineeCanBeInFile = EnToBnNumberConverter::en2bn($allowedNumberOfTrainees) . ' ' . $message;
        }
    }

    /**
     * @return array
     */
    public function getTraineeList()
    {
        return $this->ignoreEmptyRow($this->traineeList);
    }

    /**
     * @param Training $training
     * @param array $trainees
     * @return array
     */
    public function validateTraineeList(Training $training, array $trainees)
    {
        $this->brokenTraineeMobileList = [];

        if (!count($trainees)) {
            return array($this->errorList, $this->brokenTraineeMobileList);
        }

        // list all the stored and imported mobile numbers
        $totalMobileNumbers = $this->getImportedAndExistingTraineesMobileNumbers($training->id, $trainees);

        // list all the stored and imported email address, if multiple found, add an error to the list
        $totalEmailAddress = $this->getImportedAndExistingTraineesEmailId($training->id, $trainees);

        foreach ($trainees as $key => $trainee) {
            list(
                $banglaName,
                $englishName,
                $gender,
                $email,
                $mobileNo,
                $dob,
                $fatherName,
                $fatherBanglaName,
                $motherName,
                $motherBanglaName,
                $address,
                $addressBangla
                ) = $trainee;

            // check for duplicate mobile numbers
            $this->checkForDuplicateValue($totalMobileNumbers, $mobileNo);
            // check for duplicate email address
            $this->checkForDuplicateValue($totalEmailAddress, $email);

            // check for other variables
            if ($this->hasInvalidName($englishName, $banglaName)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.name_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidName($motherName, $motherBanglaName)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.name_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidName($fatherName, $fatherBanglaName)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.name_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidName($address, $addressBangla)) {
                $this->errorList[] = trans('tms::trainee)import.error_messages.name_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidGender($gender)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.gender_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidDob($dob)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.dob_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
            if ($this->hasInvalidMobileNo($mobileNo)) {
                $this->errorList[] = trans('tms::trainee_import.error_messages.mobile_format_error');
                $this->brokenTraineeMobileList[] = $mobileNo;
            }
        }
        return array($this->errorList, $this->brokenTraineeMobileList);
    }

    public function storeData(array $data, Training $training)
    {
        try {
            DB::beginTransaction();
            $trainingId = $data['training_id'];
            foreach ($data['data'] as $key => $value) {
                $data = $this->prepareTraineeServiceData($trainingId, $value);
                $trainee = $this->traineeService->save($data);
                // Trainee Service
                $traineeGeneralInfoData = $this->prepareTraineeGeneralInfoData($trainee->id, $data);
                // General Info Service
                RegisteredTraineeGeneralInfo::create($traineeGeneralInfoData);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    /*
     |------------------------------------------------------------------------------------------------------------------
     |                                       Private Methods
     |------------------------------------------------------------------------------------------------------------------
     |
    */
    /**
     * @return string[]
     */
    private function getHeaderArray(): array
    {
        return [
            'Bangla Name',
            'English Name',
            'Gender (male/female/others)',
            'Trainee Email',
            'Mobile Number (e.g: 01712345678)',
            'DOB(e.g: Y-M-D)',
            'Father Name (English)',
            'Father Name (Bangla)',
            'Mother Name (English)',
            'Mother Name (Bangla)',
            'Address (English)',
            'Address (Bangla)'
        ];
    }

    /**
     * @param Spreadsheet $spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function writeAndDownload(Spreadsheet $spreadsheet)
    {
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    /**
     * @param Spreadsheet $spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function setColumnWidthToAuto(Spreadsheet $spreadsheet)
    {
        $sheet = $spreadsheet->getActiveSheet();
        foreach (range('A', $sheet->getHighestColumn()) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    /**
     * @param Training $training
     * @return int
     */
    private function getRegisteredTraineeNumber(Training $training): int
    {
        return $training->trainee()->get()->count();
    }

    /**
     * @param Request $data
     * @param bool $unsetEmptyCells
     * @return array
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function getDataFromSpreadSheet(Request $data, $unsetEmptyCells = false): array
    {
        $extension = $data->file('import_file')->getClientOriginalExtension();

        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($data->file('import_file')->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'], null,
            false, true, false
        );
        if ($unsetEmptyCells) {
            // ignoring the empty cells
            foreach ($sheetData as $key => &$row) {
                $row = array_filter($row,
                    function ($cell) {
                        return !is_null($cell);
                    }
                );
                if (count($row) == 0) {
                    unset($sheetData[$key]);
                }
            }
        }
        return $sheetData;
    }

    private function validateFile(Request $data)
    {
        // check if any file has
        if (!$data->hasFile('import_file')) {
            return trans('labels.invalid file type');
        }
        // check extension
        if ($data->hasFile('import_file')) {
            $extension = $data->file('import_file')->getClientOriginalExtension();
            if (!in_array($extension, $this->getAllowedFileExtension())) {
                return trans('labels.invalid file type');
            }
        }
        // check mime type
        if (!in_array($data->file('import_file')->getMimeType(), $this->getAllowedFileMemes())) {
            return trans('labels.invalid file type');
        }
    }

    private function validateFileHeaderFormat(Request $data, Training $training)
    {
        $traineeList = $this->getDataFromSpreadSheet($data);

        $isFormatError = array_diff($this->getHeaderArray(), $traineeList[0]) ? true : false;

        if ($isFormatError) {
            return trans('labels.wrong_format');
        } else {
            // if everything is ok, then save the array for later checking
            unset($traineeList[0]);
            $this->traineeList = $traineeList;
        }
    }

    /**
     * @param array $traineeList
     * @param Training $training
     * @return string|null
     */
    private function checkForOverFlow(array $traineeList, Training $training)
    {
        if (!count($traineeList)) {
            return trans('tms::trainee_import.error_messages.no_data_error');
        }
        $registeredTraineeNumber = $this->getRegisteredTraineeNumber($training);

        $allowedNumberOfTrainees = $training->no_of_trainee - $registeredTraineeNumber;

        $isOverFlow = count($traineeList) > $allowedNumberOfTrainees;

        if ($isOverFlow) {
            if (!App::isLocale('bn')) {
                return 'Extra entries in the file,reduce the entries to ' . $allowedNumberOfTrainees . ' and re-upload';
            } else {
                return 'ফাইলটিতে অতিরিক্ত এন্ট্রি আছে, এন্ট্রিগুলি ' . EnToBnNumberConverter::en2bn($allowedNumberOfTrainees) . ' এ কমিয়ে দিন এবং পুনরায় আপলোড করুন';
            }
        }
        return null;
    }

    private function getAllowedFileMemes()
    {
        return array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/wps-office.xlsx'
        );
    }

    private function getAllowedFileExtension()
    {
        return [
            'csv',
            'CSV',
            'xlsx',
            'Xlsx',
            'XLSX',
            'xls'
        ];
    }

    /**
     * @param $trainingId
     * @param array $value
     * @return array
     */
    private function prepareTraineeServiceData($trainingId, array $value): array
    {
        return array(
            'training_id' => $trainingId,
            'bangla_name' => $value['bangla_name'] ?? trans('labels.not_found'),
            'english_name' => $value['english_name'] ?? trans('labels.not_found'),
            'mobile' => $value['mobile'] ?? trans('labels.not_found'),
            'email' => $value['email'] ?? trans('labels.not_found'),
            'dob' => $value['dob'] ?? trans('labels.not_found'),
            'trainee_gender' => strtolower($value['trainee_gender']) ?? trans('labels.not_found'),
            'fathers_name' => $value['fathers_name'] ?? trans('labels.not_found'),
            'fathers_name_bn' => $value['fathers_name_bn'] ?? trans('labels.not_found'),
            'mothers_name' => $value['mothers_name'] ?? trans('labels.not_found'),
            'mothers_name_bn' => $value['mothers_name_bn'] ?? trans('labels.not_found'),
            'present_address' => $value['present_address'] ?? trans('labels.not_found'),
            'present_address_bn' => $value['present_address_bn'] ?? trans('labels.not_found'),
            'photo' => 'registered-trainees/default-profile-picture.png',
            'status' => 1
        );
    }

    /**
     * @param $traineeId
     * @param array $value
     * @return array
     */
    private function prepareTraineeGeneralInfoData($traineeId, array $value): array
    {
        return array(
            'trainee_id' => $traineeId,
            'fathers_name' => $value['fathers_name'] ?? trans('labels.not_found'),
            'fathers_name_bn' => $value['fathers_name_bn'] ?? trans('labels.not_found'),
            'mothers_name' => $value['mothers_name'] ?? trans('labels.not_found'),
            'mothers_name_bn' => $value['mothers_name_bn'] ?? trans('labels.not_found'),
            'present_address' => $value['present_address'] ?? trans('labels.not_found'),
            'present_address_bn' => $value['present_address_bn'] ?? trans('labels.not_found'),
        );
    }

    // trainee list validation related private methods
    private function checkForDuplicateValue(array $haystack, $needle)
    {
        $countedValues = array_count_values($haystack);
        if ($countedValues[$needle] > 1) {
            $this->errorList[] = trans('tms::trainee_import.error_messages.duplicate_error', ['value' => $needle]);
            $this->brokenTraineeMobileList[] = $needle;
        }
    }

    /**
     * @param $englishName
     * @param $banglaName
     * @return bool
     */
    private function hasInvalidName($englishName, $banglaName): bool
    {
        // one of them must be filled !
        if ($englishName == null && $banglaName == null) {
            return true;
        }

        if (empty($englishName) && empty($banglaName)) {
            return true;
        }
        return false;
    }

    /**
     * @param $gender
     * @return bool
     */
    private function hasInvalidGender($gender): bool
    {
        $gender = strtolower($gender);
        if (!in_array($gender, array('male', 'female', 'others'))) {
            return true;
        }
        return false;
    }

    /**
     * @param $dob
     * @return bool
     */
    private function hasInvalidDob($dob): bool
    {
        try {
            if (Carbon::hasFormat($dob, 'Y-m-d')) {
                return false;
            }
            return true;
        } catch (\Exception $exception) {
            return true;
        }
    }

    /**
     * @param $mobileNo
     * @return bool
     */
    private function hasInvalidMobileNo($mobileNo): bool
    {
        $mobileNo = trim($mobileNo);
        $mobileNoLength = strlen($mobileNo);
        $mobileOperatorNumber = substr($mobileNo, 0, 3);

        if (!in_array($mobileOperatorNumber,
                array('017', '013', '014', '015', '016', '018', '019')) || $mobileNoLength != 11) {
            return true;
        }

        return false;
    }

    /**
     * @param int $trainingId
     * @param array $trainees
     * @return array
     */
    private function getImportedAndExistingTraineesMobileNumbers(int $trainingId, array $trainees): array
    {
        $existingTraineesMobileNumbers = $this->traineeService->findBy(['training_id' => $trainingId])
            ->pluck('mobile')
            ->toArray();

        // mobile numbers of trainees
        $importedTraineesMobileNumbers = array_map(function ($trainee) {
            return $trainee[4];
        }, $trainees);

        // arrays are not merged to persist key which is used later to filter mobile numbers
        return collect(array($existingTraineesMobileNumbers, $importedTraineesMobileNumbers))->flatten()->toArray();
    }

    /**
     * @param int $trainingId
     * @param array $trainees
     * @return array
     */
    private function getImportedAndExistingTraineesEmailId(int $trainingId, array $trainees): array
    {
        $existingTraineesEmail = $this->traineeService->findBy(['training_id' => $trainingId])
            ->pluck('email')
            ->toArray();

        // email id of trainees
        $importedTraineesEmail = array_map(function ($trainee) {
            return $trainee[3];
        }, $trainees);

        // arrays are not merged to persist key which is used later to filter mobile numbers
        return collect(array($existingTraineesEmail, $importedTraineesEmail))->flatten()->toArray();
    }

    private function ignoreEmptyRow(array $sheetData)
    {
        $valueFound = false;
        foreach ($sheetData as $key => $row) {
            if (empty(array_filter($row))) {
                unset($sheetData[$key]);
            }
        }
        return $sheetData;
    }

    private function getSampleData()
    {
        return [
            $this->getHeaderArray(),
            [
                'কামরুল হাসান',
                'Kamrul Hasan',
                'male',
                'sampleEmail@gmail.com',
                '12345678',
                '1980-10-20',
                'Ahmed Hasan',
                'আহমেদ হাসান',
                'Sultana Begum',
                'সুলতানা বেগম',
                'Bangladesh',
                'বাংলাদেশ'
            ]
        ];
    }
}

