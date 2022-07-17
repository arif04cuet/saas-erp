<?php

namespace Modules\TMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\TMS\Console\SendScheduledSessionNotificationToCourseAdministration;
use Modules\TMS\Console\SendScheduledSessionNotificationToSpeakerEmail;
use Modules\TMS\Console\SendScheduledSessionNotificationToTraineeEmail;
use Modules\TMS\Console\SendTraineeListToCourseAdministration;
use Modules\TMS\Console\SendWarningNotificationToTraineeEmail;
use Modules\TMS\Console\UpdateSpeakerEvaluationDeadline;

class TMSServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerCommands();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('tms.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'tms'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/tms');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/tms';
        }, \Config::get('view.paths')), [$sourcePath]), 'tms');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/tms');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tms');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'tms');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function registerCommands()
    {
        $this->commands([
            SendScheduledSessionNotificationToTraineeEmail::class,
            SendScheduledSessionNotificationToCourseAdministration::class,
            SendScheduledSessionNotificationToSpeakerEmail::class,
            SendWarningNotificationToTraineeEmail::class,
            SendTraineeListToCourseAdministration::class,
            UpdateSpeakerEvaluationDeadline::class,
        ]);
    }
}
