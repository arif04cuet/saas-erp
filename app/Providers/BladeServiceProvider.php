<?php

namespace App\Providers;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // en to bn
        Blade::directive('enToBnNumber', function ($number, $flag = true, $decimalPoint = 0) {
            $view = "<?php
                            echo \App\Utilities\EnToBnNumberConverter::en2bn(" . $number . "," . $flag . "," . $decimalPoint . ");
                ?>";
            return $view;
        });

        // convert to words
        Blade::directive('convertToWords', function ($number) {
            $view = "<?php echo \App\Utilities\EnToBnNumberConverter::convertToWords(" . $number . "); ?>";
            return $view;
        });

    }
}
