<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/10/18
 * Time: 12:10 PM
 */

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Constants\AccountConstant;
use Modules\Accounts\Entities\AccountHead;

class AccountHeadRepository extends AbstractBaseRepository
{
    protected $modelName = AccountHead::class;

    public function getHeadsForOptions()
    {
        return $this->model->select('id', DB::raw('CONCAT(code, " ", name) as name_code'))->get()->toArray();
    }

    public function getMainParentHeads()
    {
        return $this->findBy(['parent_id' => AccountConstant::PARENT]);
    }

    /**
     * @param $head
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildHead($head)
    {
        return $this->findBy(['parent_id' => $head]);
    }

    /**
     * @param $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function updateHead($id, array $data)
    {
        return $this->update($this->model->find($id), $data);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception\
     */
    public function deleteHead($id)
    {
        return $this->delete($this->model->find($id));
    }
}