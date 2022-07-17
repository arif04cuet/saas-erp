<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/5/2018
 * Time: 4:31 PM
 */

namespace Modules\HM\Services;


use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Modules\HM\Repositories\HostelBudgetSectionRepository;

class HostelBudgetSectionService
{
    use CrudTrait;

    protected $hostelBudgetSectionRepository;

    public function __construct(HostelBudgetSectionRepository $hostelBudgetSectionRepository)
    {
        $this->hostelBudgetSectionRepository = $hostelBudgetSectionRepository;
        $this->setActionRepository($this->hostelBudgetSectionRepository);

    }

    public function storeHostelBudgetSection($data = [])
    {
        if (isset($data['show_in_report'])) {
            $data['show_in_report'] = 1;
        } else {
            $data['show_in_report'] = 0;
        }
        $status = $this->save($data);
        if ($status) {
            return new Response(trans('labels.save_success'));
        } else {
            return new Response('Section not saved! Something going wrong !');
        }
    }

    public function updateBudgetSection($data = [], $id = null)
    {
        $section = $this->findOrFail($id);
        if (isset($data['show_in_report'])) {
            $data['show_in_report'] = 1;
        } else {
            $data['show_in_report'] = 0;
        }
        $status = $section->update($data);
        if ($status) {
            return new Response(trans('labels.update_success'));
        } else {
            return new Response(trans('labels.update_fail'));
        }

    }

    public function getHostelBudgetSectionLists()
    {
        return $this->findAll();
    }

    public function getHostelBudgetSectionAsPluck()
    {
        $budgetSection = $this->findAll()->pluck('name', 'id');

        return $budgetSection;
    }

    public function checkSectionAvailability($sectionId)
    {
        return $this->hostelBudgetSectionRepository->checkAvailableId($sectionId);
    }

    public function getHostelBudgetSectionsForDropdown()
    {
        return $this->findAll()->each(function ($s) {
            if (app()->isLocale('bn')) {
                $s->name = $s->title_bangla ?? trans('labels.not_found');
            } else {
                $s->name = $s->title_english ?? trans('labels.not_found');
            }
            return $s;
        })->pluck('name', 'id');
    }

}



