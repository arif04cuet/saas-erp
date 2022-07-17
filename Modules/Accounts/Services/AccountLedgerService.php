<?php
/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/21/18
 * Time: 3:17 PM
 */

namespace Modules\Accounts\Services;


use Modules\Accounts\Repositories\AccountLedgerRepository;

class AccountLedgerService
{

    protected $accountLedgerRepository;

    /**
     * AccountHeadServices constructor.
     */
    public function __construct(AccountLedgerRepository $accountLedgerRepository)
    {
        $this->accountLedgerRepository = $accountLedgerRepository;
    }

    public function getAll()
    {
        return $this->accountLedgerRepository->findAll(10);
    }

    public function getLedger($id)
    {
        return $this->accountLedgerRepository->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->accountLedgerRepository->save($data);
    }

    public function update($id, array $data)
    {
        return $this->accountLedgerRepository->updateLedger($id, $data);
    }

    public function delete($id)
    {
        return $this->accountLedgerRepository->deleteLedger($id);
    }

}