<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/21/18
 * Time: 4:19 PM
 */

namespace Modules\Accounts\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\AccountLedger;

class AccountLedgerRepository extends AbstractBaseRepository
{
    protected $modelName = AccountLedger::class;


    public function getLedgersOfHead($headId)
    {
        return $this->findBy(['account_head_id' => $headId]);
    }

    /**
     * @param null $selected
     * @return mixed
     */
    public function updateLedger($id, array $data)
    {
        return $this->update($this->model->find($id), $data);
    }

    /**
     * @param null $selected
     * @return mixed
     */
    public function deleteLedger($id)
    {
        return $this->delete($this->model->find($id));
    }

}