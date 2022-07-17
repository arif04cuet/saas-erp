<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TraineeCourseMarkValue;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseMarkAllotment;
use Modules\TMS\Entities\TrainingCourseMarkAllotmentType;
use Modules\TMS\Repositories\TrainingCourseMarkAllotmentRepository;
use Modules\TMS\Repositories\TrainingCourseMarkAllotmentTypeRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class TrainingCourseMarkAllotmentService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var TrainingCourseMarkAllotmentRepository
     */
    private $repository;

    /**
     * @var TrainingCourseMarkAllotmentTypeRepository
     */
    private $typeRepository;

    /**
     * TrainingCourseMarkAllotmentService constructor.
     * @param TrainingCourseMarkAllotmentTypeRepository $typeRepository
     * @param TrainingCourseMarkAllotmentRepository $repository
     */
    public function __construct(
        TrainingCourseMarkAllotmentTypeRepository $typeRepository,
        TrainingCourseMarkAllotmentRepository $repository
    ) {
        $this->repository = $repository;
        $this->typeRepository = $typeRepository;

        $this->setActionRepository($this->repository);
    }

    /**
     * @param $data
     * @param TrainingCourse $course
     * @return mixed
     */
    public function update($data, TrainingCourse $course)
    {
        return DB::transaction(function () use ($data, $course) {
            $delete = $course->markAllotments()->delete();

            if (!empty($data)) {
                return $course->markAllotments()->createMany($data);
            }

            return $delete;
        });
    }

    /**
     * @param TrainingCourse $course
     * @return mixed
     */
    public function getMarkAllotmentTypeTitles(TrainingCourse $course)
    {
        $markAllotmentTypes = $course->markAllotments->map(function ($markAllotment) {
            return trans('tms::mark_allotment_type.' . $markAllotment->type->title) . " (" . $markAllotment->mark . ")";
        });
        return $markAllotmentTypes;
    }

    public function getMarkAllotmentTypes(TrainingCourse $course)
    {
        $markAllotmentTypes = $course->markAllotments->map(function ($markAllotment) {
            return
                (object)[
                    'id' => $markAllotment->type->id,
                    'title' => trans('tms::mark_allotment_type.' . $markAllotment->type->title) . " (" . $markAllotment->mark . ")"
                ];

        });
        return $markAllotmentTypes;
    }

    public function generateXlsx($traineesWithMarks, $markAllotmentTypes)
    {
        //dd($markAllotmentTypes);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //$markAllotmentTypes = TrainingCourseMarkAllotmentType::select('id','title')->get();

        $sheet->setCellValue('A1', 'Trainee Name');
        $sheet->setCellValue('B1', 'Trainee ID');

        $columnCells = [];
        $key = 0;
        foreach ($markAllotmentTypes as $allotmentType) {
            $column = ($key < 24) ? chr(67 + $key) : chr(65) . chr(41 + $key);

            $sheet->setCellValue($column . '1', $allotmentType->title);
            $sheet->setCellValue($column . '2', $allotmentType->id);
            $columnCells[$allotmentType->id] = $column;
            $key++;
        }

        foreach ($traineesWithMarks as $key => $traineesWithMark) {
            $sheet->setCellValue('A' . ($key + 3), $traineesWithMark->full_name);
            $sheet->setCellValue('B' . ($key + 3), $traineesWithMark->id);

            foreach ($traineesWithMark->achieved_marks as $achieved_mark) {
                if (in_array($achieved_mark->mark_allotment_type_id, array_keys($columnCells))) {
                    $sheet->setCellValue(
                        $columnCells[$achieved_mark->mark_allotment_type_id] . ($key + 3),
                        $achieved_mark->value
                    );
                }
            }
        }

        $spreadsheet->getActiveSheet()->
        getStyle('B1')->
        getProtection()->
        setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
        $path = public_path() . '/files/mark_value_import_sample.xls';
        $writer->save($path);
    }

    public function importCSV(Request $data)
    {
        $extension = $data->file('import_file')->getClientOriginalExtension();

        //dd($extension);

        if (!$extension) {
            Session::flash('error', 'Mark should be less than or equal from total value');
        }

        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xls();
        }

        $spreadsheet = $reader->load($data->file('import_file')->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'], null,
            false, true, false
        );
        return $sheetData;
    }

    public function storeImported(array $data, $courseId)
    {
        
        $courseAllotments = $data[1];

        unset($courseAllotments[0]);
        unset($courseAllotments[1]);
        
        $markValues = $data;

        unset($markValues[0]);
        unset($markValues[1]);

        DB::beginTransaction();
        try {
            TraineeCourseMarkValue::query()->truncate();
            foreach ($courseAllotments as $key => $courseAllotment) {
                
                foreach ($markValues as $markValue) {
                    $allotmetTypeValue = TrainingCourseMarkAllotment::select('id', 'mark')
                    ->where([
                        ['training_course_id', '=', $courseId],
                        ['training_course_mark_allotment_type_id', '=', $courseAllotment]
                    ])->first();
                    if ($markValue[$key]) {
                        if ((int)$allotmetTypeValue->mark >= (int)$markValue[$key]) {
                            $markData = new TraineeCourseMarkValue;
                            $markData->trainee_id = (int)$markValue[1];
                            $markData->training_course_id = (int)$courseId;
                            $markData->training_course_mark_allotment_type_id = (int)$courseAllotment;
                            $markData->value = (int)$markValue[$key];

                            $markData->save();
                        } else {
                            app()->isLocale('en')
                                ? Session::flash('error', 'Mark should be less than or equal from total value')
                                : Session::flash('error', 'অর্জিত মার্ক বরাদ্দকৃত মার্ক এর সমান অথবা বড় হতে হবে।');
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Mark Value Import Error: ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            Session::flash('error', trans('labels.generic_error_message'));
        }
    }

}
