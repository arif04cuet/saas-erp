<?php

/**
 * Created by vs code.
 * User: Araf
 * Date: 1/06/2022
 * Time: 11:11 AM
 */

namespace App\Services\workflow;


use App\Services\workflow\Generators\BaseDashboardItemGenerator;
use App\Services\workflow\Generators\ResearchProposalItemGenerator;
use Illuminate\Support\Facades\App;

abstract class DashboardItemGeneratorFactory
{
    public static function getDashboardItemGenerator($feature): BaseDashboardItemGenerator
    {

        switch ($feature) {
            case 'Research Proposal':
                return app()->make('App\Services\workflow\Generators\ResearchProposalItemGenerator');
            case 'Project Brief Proposal':
                return app()->make('App\Services\workflow\Generators\ProjectProposalItemGenerator');
            case 'Research Workflow':
                return app()->make('App\Services\workflow\Generators\ResearchItemGenerator');

            case 'Project Details Proposal':
                return app()->make('App\Services\workflow\Generators\ProjectDetailProposalItemGenerator');
            case 'Research Details Proposal':
                return app()->make('App\Services\workflow\Generators\ResearchProposalDetailItemGenerator');
        }
    }
}
