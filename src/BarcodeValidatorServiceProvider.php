<?php

namespace Cpuch\BarcodeValidator;

use Illuminate\Support\ServiceProvider;

class BarcodeValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //
        $this->loadTranslationsFrom(__DIR__.'/lang', 'barcode-validator');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/barcode-validator'),
        ], 'barcode-validator-translations');
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        //
    }
}
