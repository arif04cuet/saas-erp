<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/5/2018
 * Time: 4:31 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\HostelBudgetSection;

class HostelBudgetSectionRepository extends AbstractBaseRepository {
	protected $modelName = HostelBudgetSection::class;

	public function checkAvailableId($id){
		$section = HostelBudgetSection::where('id', $id)->first();
		return$section;
	}

}