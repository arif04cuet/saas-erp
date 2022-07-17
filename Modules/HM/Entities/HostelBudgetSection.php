<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class HostelBudgetSection extends Model
{
    protected $fillable = ['title_english', 'title_bangla', 'show_in_report', 'show_as'];

    public static function getReportShowOptions($keysOnly = false)
    {
        $options = null;
        if (app()->isLocale('en')) {
            $options = config('hm.accounts.section.type_en');
        } else {
            $options = config('hm.accounts.section.type_bn');
        }
        if ($keysOnly) {
            return array_keys($options);
        }
        return $options;
    }

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bangla ?? trans('labels.not_found');
        }
        return $this->title_english ?? trans('labels.not_found');
    }

}
