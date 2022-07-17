<?php

namespace Modules\Publication\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Publication\Repositories\PublicationInventoryRepository;
use Modules\Publication\Services\PublicationInventoryTransactionService;

class PublicationInventoryService
{
    use CrudTrait;

    private $publicationInventoryRepository;

    public function __construct(
        PublicationInventoryRepository $publicationInventoryRepository,
        PublicationInventoryTransactionService $publicationInventoryTransactionService
    ) {
        $this->publicationInventoryRepository = $publicationInventoryRepository;
        $this->publicationInventoryTransactionService = $publicationInventoryTransactionService;
        $this->setActionRepository($this->publicationInventoryRepository);
    }

    public function storeInInventory(array $data)
    {
        DB::transaction(function () use ($data) {
            $exist = $this->publicationInventoryRepository->checkIfExist($data['published_research_paper_id']);
            if ($exist) {
                $publication = $this->publicationInventoryRepository->storeIfExist($data);
                $available_amount = $publication->available_amount;
                $publication->previous_amount = $available_amount;
                $publication->available_amount = $available_amount + $data['available_amount'];
                $id = $publication->id;
                $publication->save();
                $this->publicationInventoryTransactionService->storeInTransaction($data, $id, 'added');
            } else {
                $data['previous_amount'] = 0;
                $inventory = $this->publicationInventoryRepository->save($data);
                $id = $inventory['id'];
                $this->publicationInventoryTransactionService->storeInTransaction($data, $id, 'added');
            }
        });
    }

    public function distributeFromInventory(array $data)
    {
        DB::transaction(function () use ($data) {
            $publication = $this->publicationInventoryRepository->storeIfExist($data);
            $available_amount = $publication->available_amount;
            $publication->previous_amount = $available_amount;
            $publication->available_amount = $available_amount - $data['quantity'];
            $id = $publication->id;
            $publication->save();
            $this->publicationInventoryTransactionService->storeInTransaction($data, $id, 'distributed');
        });
    }

    public function getInventoryByPublishedPaperId($id)
    {
        return $this->publicationInventoryRepository->getInventoryByPublishedPaperId($id);
    }
}
