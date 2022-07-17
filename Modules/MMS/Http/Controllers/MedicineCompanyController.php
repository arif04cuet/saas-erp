<?php

namespace Modules\MMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MMS\Http\Requests\CompanyRequest;
use Modules\MMS\Services\MedicineCompanyService;
use Modules\MMS\Entities\MedicineCompany;
use Modules\MMS\Services\MedicineService;
use Session;

class MedicineCompanyController extends Controller
{
    /**
     * @var $medicineCompanyService
     */
    private $medicineCompanyService;

    /**
     * @var $medicineService
     */
    private $medicineService;

    /**
     * @param MedicineCompanyService $medicineCompanyService
     * @param MedicineService $medicineService
     */

    public function __construct(
        MedicineCompanyService $medicineCompanyService,
        MedicineService $medicineService
    )
    {
        $this->medicineCompanyService = $medicineCompanyService;
        $this->medicineService = $medicineService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $company = $this->medicineCompanyService->findAll();
        return view('mms::company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('mms::company.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CompanyRequest $request
     * @return Response
     */
    public function store(CompanyRequest $request)
    {
        $this->medicineCompanyService->save($request->all());
        return redirect()->route('company.index')->with('success', __('labels.save_success'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $company = $this->medicineCompanyService->findOne($id);

        return view('mms::company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $company = $this->medicineCompanyService->findBy(['id' => $id])->first();
        $page = "edit";

        return view('mms::company.create', compact('company', 'company', 'page'));

    }

    /**
     * Update the specified resource in storage.
     * @param CompanyRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $this->medicineCompanyService->findOrFail($id)->update($request->all());

        return redirect()->route('company.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $medicineCompany
     * @param $id
     * @return Response
     */
    public function destroy(MedicineCompany $medicineCompany, $id)
    {
        $checkMedicineAllReadyUse = $this->medicineService->findBy(['company_id' => $id])->count();
        if ($checkMedicineAllReadyUse < 1) {
            $medicineCompany->destroy($id);
            Session::flash('warning', trans('labels.delete_success'));
        } else {
            Session::flash('warning', trans('mms::medicine.already_in_use'));
        }

        return redirect()->route('company.index');
    }

}

