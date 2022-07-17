<?php


namespace Modules\Publication\Repositories;

use Modules\Publication\Entities\PublicationInventory;
use App\Repositories\AbstractBaseRepository;



class PublicationInventoryRepository extends AbstractBaseRepository
{

    protected $modelName = PublicationInventory::class;

    public function checkIfExist($id)
    {
        if ($this->model->where('published_research_paper_id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function storeIfExist($data)
    {
        return $this->model->where('published_research_paper_id', $data['published_research_paper_id'])->first();
    }
    public function getInventoryByPublishedPaperId($id)
    {
        return $this->model->where('published_research_paper_id', $id)->first();
    }
}
