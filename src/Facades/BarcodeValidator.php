<?php

namespace Cpuch\BarcodeValidator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cpuch\BarcodeValidator\BarcodeValidator
 */
class BarcodeValidator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Cpuch\BarcodeValidator\BarcodeValidator::class;
    }
}
