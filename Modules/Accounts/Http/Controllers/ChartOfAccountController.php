<?php

namespace Modules\Accounts\Http\Controllers;

use App\Traits\FileTrait;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\EconomyHead;
use Modules\Accounts\Imports\ImportEconomicCode;
use Modules\Accounts\Services\EconomyHeadService;
use Maatwebsite\Excel\Facades\Excel;

class ChartOfAccountController extends Controller
{
    use FileTrait;
    private $economyHeadService;

    public function __construct(EconomyHeadService $economyHeadService)
    {
        $this->economyHeadService = $economyHeadService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $economyCodes = $this->economyHeadService->getTypeHeads();
        return view('accounts::chart-of-account.index', compact('economyCodes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('attachment');
        try {
            $this->validate($file);
            $headings = (new HeadingRowImport())->toArray($file);
            $collection = collect($headings)->flatten()->take(9);
            $headRows = ImportEconomicCode::HEAD_ROWS;
            if (!$collection->diff($headRows)->count()) {
                $this->importEconomyCode($file);
            } else {
                $this->throwException('Format was wrong');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->route('chart-of-accounts.index');
    }

    /**
     * @param $message
     * @throws \Exception
     */
    private function throwException($message)
    {
        throw new \Exception($message);
    }

    /**
     * @param $file
     */
    private function importEconomyCode($file): void
    {
        EconomyCode::truncate();
        EconomyHead::truncate();
        Excel::import(new ImportEconomicCode(), $file);
        Session::flash('success', 'Imported Successfully');
    }

    /**
     * @param $file
     * @throws \Exception
     */
    private function validate($file): void
    {
        if (is_null($file)) {
            $this->throwException('Please select a file');
        }
        $extension = $file->getClientOriginalExtension();
        if ($extension != ImportEconomicCode::EXTENSION) {
            $this->throwException("Please select a xlsx format file");
        }
    }

    public function downloadSampleFile()
    {
        $filename = 'economy_code.xlsx';
        return response()->download(public_path("{$filename}"));
    }

}
