<?php

namespace Modules\Publication\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Publication\Repositories\PublicationInventoryTransactionRepository;


class PublicationInventoryTransactionService
{
    use CrudTrait;

    public function __construct(PublicationInventoryTransactionRepository $publicationInventoryTransactionRepository)
    {
        $this->publicationInventoryTransactionRepository = $publicationInventoryTransactionRepository;
        $this->setActionRepository($this->publicationInventoryTransactionRepository);
    }

    public function storeInTransaction($data, $id, $flag)
    {
        $transaction['publication_inventory_id'] = $id;
        $transaction['date'] = date('Y-m-d');
        if ($flag == 'added') {
            $transaction['quantity'] = $data['available_amount'];
            $transaction['status'] = 'add';
        } else {
            $transaction['reference_table_id'] = $data['reference_table_id'];
            $transaction['reference_table'] = $data['reference_table'];
            $transaction['quantity'] = $data['quantity'];
            $transaction['status'] = 'distribute';
        }
        $this->save($transaction);
    }
}
