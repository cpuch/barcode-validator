<?php

namespace Cpuch\BarcodeValidator;

use Illuminate\Support\Str;

class BarcodeValidator
{
    /**
     * Validate an EAN or UPC barcode.
     *
     * Supports EAN-8, UPC-A, and EAN-13 formats.
     *
     * @param  string  $value  The barcode value to validate.
     * @return bool True if the barcode is valid, false otherwise.
     */
    public static function validate(string $value): bool
    {
        // Check if the barcode is of valid length and contains only digits
        if (! preg_match('/^[0-9]{8}$|^[0-9]{12}$|^[0-9]{13}$/', $value) || preg_match('/^0+$/', $value)) {
            return false;
        }

        $length = Str::length($value);

        // Separate the data portion from the check digit
        $data = Str::substr($value, 0, $length - 1);
        $check_digit = (int) Str::substr($value, -1);

        // Validate the check digit
        return self::calculateCheckDigit($data, $length) === $check_digit;
    }

    /**
     * Calculate the check digit using the standard EAN/UPC algorithm.
     *
     * @param  string  $data  The data portion of the barcode (without check digit).
     * @return int The calculated check digit.
     */
    private static function calculateCheckDigit(string $data, int $length): int
    {
        // Initialize sum for weighted calculation
        $check_sum = 0;

        // Convert string to array of digits
        $digits = str_split($data);

        // Calculate weighted sum
        // Odd positions (index 0,2,4...) × 3
        // Even positions (index 1,3,5...) × 1
        foreach ($digits as $index => $digit) {
            $digit = (int) $digit;
            $check_sum += $index % 2 === 0 ? $digit * 3 : $digit;
        }

        // Calculate the check digit (mod 10)
        return (10 - ($check_sum % 10)) % 10;
    }
}
