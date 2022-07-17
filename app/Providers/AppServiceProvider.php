<?php

namespace App\Providers;

use App\Services\AppraisalWorkflowManager;
use App\Services\ComplaintInvitationWorkflowManager;
use App\Services\ComplaintWorkflowManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Modules\HRM\Entities\Complaint;
use Modules\HRM\Entities\ComplaintInvitation;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectDetailProposal;
use Modules\RMS\Entities\Research;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'project' => Project::class,
            'project_detail_proposal' => ProjectDetailProposal::class,
            'research' => Research::class,
        ]);

        Carbon::setWeekendDays([Carbon::SATURDAY, Carbon::FRIDAY]);

        Blade::component('layouts.partials.error', 'error');
        Schema::defaultStringLength(200);

        $this->setupDashboardClient();

        // DB::listen(function ($query) {
        //     logger([
        //         $query->sql,
        //         $query->bindings,
        //         $query->time
        //     ]);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ComplaintInvitationWorkflowManager', function () {
            return new ComplaintInvitationWorkflowManager();
        });

        $this->app->bind('ComplaintWorkflowManager', function () {
            return new ComplaintWorkflowManager();
        });

        $this->app->bind('AppraisalWorkflowManager', function () {
            return new AppraisalWorkflowManager();
        });
    }

    public function setupDashboardClient()
    {
        $that = $this;
        Http::macro('dashboard', function () use ($that) {

            $apiUrl = config('services.dashboard.api_url');
            $token = $that->getDashboardToken($apiUrl);

            $client = Http::acceptJson()
                ->withHeaders([
                    'api-version' => 1
                ])
                ->withToken($token)
                ->baseUrl($apiUrl);

            return $client;
        });
    }

    public function getDashboardToken($doptorBaseUrl)
    {
        return Cache::remember('doptor-token', 72000, function () use ($doptorBaseUrl) {
            return Http::post($doptorBaseUrl . '/oauth/token', [
                "grant_type" => "client_credentials",
                "client_id" => config('services.dashboard.client_id'),
                "client_secret" => config('services.dashboard.client_secret'),
            ])->json('access_token');
        });
    }
}
