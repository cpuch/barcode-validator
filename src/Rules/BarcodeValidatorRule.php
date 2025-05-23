<?php

namespace Cpuch\BarcodeValidator\Rules;

use Cpuch\BarcodeValidator\BarcodeValidator;
use Illuminate\Contracts\Validation\ValidationRule;

class BarcodeValidatorRule implements ValidationRule
{
    /**
     * Determine if the validation rule passes.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (! BarcodeValidator::validate($value)) {
            $fail('The :attribute is not a valid UPC or EAN barcode.');
        }
    }
}
