<?php

namespace Cpuch\BarcodeValidator\Rules;

use Cpuch\BarcodeValidator\BarcodeValidator;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Laravel validation rule for UPC and EAN barcode validation.
 *
 * This rule validates that a string value represents a valid barcode
 * according to UPC or EAN standards, including check digit verification.
 */
class BarcodeValidatorRule implements ValidationRule
{
    /**
     * Determine if the validation rule passes.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (! BarcodeValidator::validate($value)) {
            $fail(__('barcode-validator::messages.invalid_barcode'));
        }
    }
}
