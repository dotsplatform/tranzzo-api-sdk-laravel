<?php
/**
 * Description of TranzzoServiceProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo;

use Illuminate\Support\ServiceProvider;



class TranzzoServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rozetka-pay.php',
            'rozetka-pay'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/rozetka-pay.php' => config_path('rozetka-pay.php'),
        ], 'config');
    }
}