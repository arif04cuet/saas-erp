<?php

namespace App\Http\Controllers;

use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Services\DoptorService;
use App\Services\ModuleService;
use Illuminate\Support\Facades\Session;
use App\Models\Doptor;
use App\Models\Module;
use App\Models\DoptorModule;
use Closure;

class DoptorController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $doptorService;
    private $moduleService;

    const MODEL = 'Module';

    public function __construct(ModuleService $moduleService, DoptorService $doptorService)
    {
        $this->doptorService = $doptorService;
        $this->moduleService = $moduleService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doptors = Doptor::all();
        return view('doptor.index', compact('doptors'));
    }

    /**
     * <h3>Doptor Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getDoptorsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null, array $query = null, $isEmptyOption = false)
    {
        $users = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $users,
            $implementedKey,
            $implementedValue ?: function ($user) {
                return $user->name . ' - ' . $user->email;
            },
            $isEmptyOption
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', self::MODEL);
        $doptor = $this->doptorService->find($id);
        return view('doptor.show', compact('doptor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doptor = Doptor::find($id);
        $module = Module::all()->toArray();
        // $assignModules = $this->moduleService->pluck();
        return view('doptor.edit', compact('doptor', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->doptorService->updateDoptor($id, $request->all());
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('doptors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
