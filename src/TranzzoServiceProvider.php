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
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tranzzo.php',
            'tranzzo'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/tranzzo.php' => config_path('tranzzo.php'),
        ], 'config');
    }
}
