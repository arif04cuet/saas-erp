<?php

/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/6/2018
 * Time: 2:52 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\HM\Entities\HostelBudgetTitle;

class HostelBudgetTitleRepository extends AbstractBaseRepository
{
    protected $modelName = HostelBudgetTitle::class;

    public function getHostelBudgetTitle()
    {
        $currentYear = Carbon::now()->addYear(-1)->year;
        $titles = HostelBudgetTitle::where('current_year', ">=", $currentYear)
            ->whereStatus(0)
            ->get()->pluck('name', 'id');

        return $titles;
    }

    public function getHostelBudgets(array $idArray)
    {
        return $this->getModel()->newQuery()->whereIn('id', $idArray)->get();
    }

    public function getTitleWithHostelBudget($id)
    {
        $titleWithBudget = HostelBudgetTitle::whereId($id)->with('hostelBudgets')->first();

        return $titleWithBudget;
    }

    public function getApproveOrPendingTitle()
    {
        $hostelBudgets = HostelBudgetTitle::where('status', '!=', 0)->orderBy('updated_at', 'desc')->get();
        return $hostelBudgets;
    }

    public function getHostelBudgetTitleForDropdown($plusMinusFromThisYear = 0, $onlyWithBudgets = false)
    {
        $currentYear = Carbon::now()->addYear($plusMinusFromThisYear)->year;
        $titles = HostelBudgetTitle::where('current_year', ">=", $currentYear)
            ->get();
        if ($onlyWithBudgets) {
            $titles = $titles->filter(function ($t) {
                if (!empty($t->hostelBudgets()->count())) {
                    return $t;
                }
            });
        }
        return $titles->pluck('name', 'id');
    }
}
