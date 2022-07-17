<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\GpfRecord;

class GpfRecordRepository extends AbstractBaseRepository {

    protected $modelName = GpfRecord::class;
}
