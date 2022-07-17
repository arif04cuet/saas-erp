<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 3/6/19
 * Time: 5:39 PM
 */

namespace App\Traits;


use App\Utilities\ExcelExporter;
use Maatwebsite\Excel\Facades\Excel;

trait ExcelExportTrait
{

    public function downloadExcel($data, $viewName, $fileNameWithExtension){

        return Excel::download(new ExcelExporter($viewName , $data), $fileNameWithExtension);
    }
}