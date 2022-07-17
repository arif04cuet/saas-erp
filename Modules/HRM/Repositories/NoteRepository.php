<?php

    namespace Modules\HRM\Repositories;

    use Modules\HRM\Entities\Note;
    use App\Repositories\AbstractBaseRepository;

    class NoteRepository extends AbstractBaseRepository
    {
        protected $modelName = Note::class;

    }