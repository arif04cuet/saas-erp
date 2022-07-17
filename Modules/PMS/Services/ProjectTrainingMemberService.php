<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/6/19
 * Time: 4:09 PM
 */

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Repositories\ProjectTrainingMemberRepository;

class ProjectTrainingMemberService
{
    use CrudTrait;

    /**
     * @var ProjectTrainingMemberRepository
     */
    private $projectTrainingMemberRepository;

    public function __construct(ProjectTrainingMemberRepository $projectTrainingMemberRepository)
    {
        $this->projectTrainingMemberRepository = $projectTrainingMemberRepository;
        $this->setActionRepository($projectTrainingMemberRepository);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $memberIds = explode(',', $data['members']);

            foreach ($memberIds as $memberId) {
                $this->save([
                    'member_id' => $memberId,
                    'training_id' => $data['training_id'],
                ]);
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

}