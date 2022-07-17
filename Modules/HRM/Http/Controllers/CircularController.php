<?php

    namespace Modules\HRM\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Storage;
    use Modules\HRM\Entities\Circular;
    use Modules\HRM\Entities\CircularAttachment;
    use Modules\HRM\Http\Requests\StoreUpdateCircularRequest;
    use Modules\HRM\Services\CircularService;

    class CircularController extends Controller
    {
        private $circularService;


        public function __construct(CircularService $circularService)
        {
            $this->circularService = $circularService;
        }

        /**
         * Display a listing of the resource.
         * @return Response
         */
        public function index()
        {
            $circulars = $this->circularService->getAllCircularForCurrentUser();
            return view('hrm::circular.index', compact('circulars'));
        }

        /**
         * Show the form for creating a new resource.
         * @return Response
         */
        public function create()
        {
            $viewData = $this->circularService->createViewPrepare();
            return view('hrm::circular.create', $viewData);
        }

        /**
         * @param StoreUpdateCircularRequest $storeUpdateCircularRequest
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(StoreUpdateCircularRequest $storeUpdateCircularRequest)
        {
            $request = $storeUpdateCircularRequest->all();

            $request['initiator_id'] = Auth::user()->employee->id;

            $circular = $this->circularService->store($request);
            if ($circular) {
                Session::flash('success', trans('labels.save_success'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }

            return redirect()->route('circular.index');
        }

        /**
         * Show the specified resource.
         * @param Circular $circular
         * @return Response
         */
        public function show(Circular $circular)
        {
            return view('hrm::circular.show', compact('circular'));
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            return view('hrm::circular.edit');
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

        /**
         * Show all the public circular
         * @return  Response
         */
        public function getAllPublicCircular()
        {
            $publicCirculars = $this->circularService->getAllPublicCirculars();

            return view('hrm::circular.public.index', compact('publicCirculars'));
        }

        public function attachmentDownload(CircularAttachment $circularAttachment)
        {
            $basePath = Storage::disk('internal')->path($circularAttachment->file_path);
            return response()->download($basePath);
        }

    }
