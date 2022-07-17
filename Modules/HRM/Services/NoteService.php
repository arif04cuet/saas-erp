<?php


    namespace Modules\HRM\Services;

    use App\Traits\CrudTrait;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Auth;
    use Modules\HRM\Repositories\NoteRepository;

    class NoteService
    {

        use CrudTrait;

        private $noteRepository;

        public function __construct(NoteRepository $noteRepository)
        {
            $this->setActionRepository($noteRepository);
        }

        /**
         * @return Collection
         */
        public function getUserNotes()
        {
            return $this->findBy(['user_id' => Auth::id()], null, ['column' => 'created_at', 'direction' => 'desc']);
        }

    }