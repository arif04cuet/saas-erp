<?php

    namespace Modules\HRM\Repositories;

    use Modules\HRM\Entities\NoteType;
    use App\Repositories\AbstractBaseRepository;

    class NoteTypeRepository extends AbstractBaseRepository
    {

        protected $modelName = NoteType::class;

    }