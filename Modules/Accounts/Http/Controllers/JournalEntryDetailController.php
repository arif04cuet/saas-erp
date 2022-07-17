<?php
namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\JournalEntryDetailService;

class JournalEntryDetailController extends Controller
{

    /**
     * @var JournalEntryDetailService
     */
    private $journalEntryDetailService;

    public function __construct(JournalEntryDetailService $journalEntryDetailService)
    {
        $this->journalEntryDetailService = $journalEntryDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('accounts::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @param $status
     *
     * @return RedirectResponse
     */
    public function changeStatus($id, $status)
    {
        $model = $this->journalEntryDetailService->findOne($id);
        if ($this->journalEntryDetailService->changeStatus($model, $status)) {
            return redirect()->route('journal.entry.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('journal.entry.index')
                ->with('success', trans('labels.save_success'));
        }
    }
}
