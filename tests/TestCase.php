<?php

namespace Cpuch\BarcodeValidator\Tests;

use Cpuch\BarcodeValidator\BarcodeValidatorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BarcodeValidatorServiceProvider::class,
        ];
    }
}
