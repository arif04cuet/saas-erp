<?php


    namespace Modules\Accounts\Repositories;

    use App\Repositories\AbstractBaseRepository;
    use Modules\Accounts\Entities\RevenueBudget;

    class RevenueBudgetRepository extends AbstractBaseRepository
    {
        protected $modelName = RevenueBudget::class;
    }
