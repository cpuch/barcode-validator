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
        if (! preg_match('/^[0-9]{8}$|^[0-9]{12}$|^[0-9]{13}$/', $value)) {
            return false;
        }

        $length = Str::length($value);
        // Separate the data portion from the check digit
        $data = Str::substr($value, 0, $length - 1);
        $check_digit = (int) Str::substr($value, -1);

        // Validate the check digit
        return self::calculateCheckDigit($data) === $check_digit;
    }

    /**
     * Calculate the check digit using the standard EAN/UPC algorithm.
     *
     * @param  string  $data  The data portion of the barcode (without check digit).
     * @return int The calculated check digit.
     */
    private static function calculateCheckDigit(string $data): int
    {
        // Pad the data to ensure it is the correct length for calculation
        if (Str::length($data) === 7) {
            $data = Str::padLeft($data, 8, '0');
        } else {
            $data = Str::padLeft($data, 12, '0');
        }

        $check_sum = 0;
        foreach (str_split($data) as $index => $digit) {
            $digit = (int) $digit;
            // Apply weighting pattern: odd positions × 3, even positions × 1
            // Note: For EAN/UPC, we're applying the right-to-left pattern
            $check_sum += $index % 2 === 0 ? $digit : $digit * 3;
        }

        // Calculate the check digit (mod 10)
        return (10 - ($check_sum % 10)) % 10;
    }
}
