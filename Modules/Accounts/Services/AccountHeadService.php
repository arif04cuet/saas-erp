<?php
/**
 * Created by PhpStorm.
 * User: Tanvir
 * Date: 10/10/18
 * Time: 12:12 PM
 */

namespace Modules\Accounts\Services;


use Illuminate\Http\Response;
use Modules\Accounts\Repositories\AccountHeadRepository;

class AccountHeadService
{
    protected $accountHeadRepository;

    /**
     * AccountHeadServices constructor.
     */
    public function __construct(AccountHeadRepository $accountHeadRepository)
    {
       $this->accountHeadRepository  = $accountHeadRepository;
    }

    public function getAll()
    {
        return $this->accountHeadRepository->findAll(10);
    }

    public function getHeads()
    {
        $heads = $this->accountHeadRepository->getHeadsForOptions();

        return array_column($heads, 'name_code', 'id');
    }

    public function getHead($id)
    {
        return $this->accountHeadRepository->findOrFail($id);
    }

    public function store(array $data)
    {
        $this->accountHeadRepository->save($data);

        return new Response('Account Head stored successfully!', Response::HTTP_OK);
    }

    public function update($id, array $data)
    {
        $this->accountHeadRepository->updateHead($id, $data);

        return new Response('Account Head updated successfully!', Response::HTTP_OK);
    }

    public function delete($id)
    {
        $this->accountHeadRepository->deleteHead($id);
        return new Response('Account Head deleted successfully!', Response::HTTP_OK);
    }

}