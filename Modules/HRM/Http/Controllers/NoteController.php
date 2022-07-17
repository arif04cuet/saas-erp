<?php

    namespace Modules\HRM\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Session;
    use Modules\HRM\Entities\Note;
    use Modules\HRM\Services\NoteService;
    use Modules\HRM\Services\NoteTypeService;
    use Illuminate\Support\Facades\Validator;

    class NoteController extends Controller
    {
        private $noteTypeService;
        private $noteService;

        public function __construct(NoteTypeService $noteTypeService,
                                    NoteService $noteService)
        {
            $this->noteTypeService = $noteTypeService;
            $this->noteService = $noteService;
        }

        /**
         * Display a listing of the resource.
         * @return Response
         */
        public
        function index()
        {
            $notes = $this->noteService->getUserNotes();

            return view('hrm::note.index', compact('notes'));
        }

        /**
         * Show the form for creating a new resource.
         * @return Response
         */
        public function create()
        {
            $noteTypes = $this->noteTypeService->getDropDownOptions();
            return view('hrm::note.create', compact('noteTypes'));
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            //validation
            $messages = [
                'note_type_id.required' => 'A type should be selected',
            ];
            $rules = [
                'title' => 'required|max:100',
                'note_type_id' => 'required',
                'details' => 'required',
            ];

            Validator::make($request->all(), $rules, $messages)->validate();

            $note = $this->noteService->save($request->all());
            if ($note) {
                Session::flash('success', trans('labels.save_success'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }
            return redirect()->route('note.index');
        }

        /**
         * Show the specified resource.
         * @return Response
         */
        public function show(Note $note)
        {
            return view('hrm::note.show', compact('note'));
        }

        /**
         * Show the form for editing the specified resource.
         * @return Response
         */
        public function edit()
        {
            return view('hrm::note.edit');
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @return Response
         */
        public function update(Request $request)
        {
        }

        /**
         * Remove the specified resource from storage.
         * @return Response
         */
        public function destroy()
        {

        }
    }
