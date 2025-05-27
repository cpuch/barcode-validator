<?php

namespace Cpuch\BarcodeValidator;

use Cpuch\BarcodeValidator\Rules\BarcodeValidatorRule;
use Illuminate\Support\ServiceProvider;

class BarcodeValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // Load translations
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'barcode-validator');

        // Publishable resources
        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/barcode-validator'),
        ], 'barcode-validator-translations');

        // Register validation rule
        $this->app['validator']->extend('barcode', function ($attribute, $value, $parameters) {
            return (new BarcodeValidatorRule)->validate($attribute, $value, function () {
                return false;
            });
        });
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->singleton(BarcodeValidator::class, function ($app) {
            return new BarcodeValidator;
        });
    }
}
