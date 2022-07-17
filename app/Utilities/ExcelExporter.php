<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 3/6/19
 * Time: 4:36 PM
 */

namespace App\Utilities;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExporter implements FromView
{
    protected $data;
    protected $viewName;

    /**
     * ExcelExporter constructor.
     *
     * @param array $data
     * @param $viewName
     */
    public function __construct($viewName, array $data)
    {
        $this->data = $data;
        $this->viewName = $viewName;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view($this->viewName, $this->data);
    }
}