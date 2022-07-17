<?php

    namespace Modules\HRM\Services;

    use App\Traits\CrudTrait;
    use App\Utilities\DropDownDataFormatter;
    use Modules\HRM\Repositories\NoteTypeRepository;

    class NoteTypeService
    {
        use CrudTrait;

        public function __construct(NoteTypeRepository $noteTypeRepository)
        {
            $this->setActionRepository($noteTypeRepository);
        }

        public function getDropDownOptions()
        {
            return DropDownDataFormatter::getFormattedDataForDropdown($this->findAll());
        }
    }