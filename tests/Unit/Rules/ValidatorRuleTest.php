<?php

namespace Tests\Unit\Rules;

use Cpuch\BarcodeValidator\Rules\BarcodeValidatorRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidatorRuleTest extends TestCase
{
    /**
     * Test validation of valid barcodes.
     */
    #[Test]
    #[DataProvider('validBarcodeProvider')]
    public function test_valid_barcodes_pass(string $barcode, ?array $options = null): void
    {
        $rule = $options ? new BarcodeValidatorRule($options) : new BarcodeValidatorRule;

        $failCalled = false;
        $failCallback = function () use (&$failCalled) {
            $failCalled = true;

            return 'Error message';
        };

        $rule->validate('barcode', $barcode, $failCallback);

        $this->assertFalse($failCalled, "Validation should pass for {$barcode}");
    }

    /**
     * Test validation of invalid barcodes.
     */
    #[Test]
    #[DataProvider('invalidBarcodeProvider')]
    public function test_invalid_barcodes_fail(string $barcode, ?array $options = null): void
    {
        $rule = $options ? new BarcodeValidatorRule($options) : new BarcodeValidatorRule;

        $failCalled = false;
        $failMessage = null;
        $failCallback = function ($message) use (&$failCalled, &$failMessage) {
            $failCalled = true;
            $failMessage = $message;

            return $message;
        };

        $rule->validate('barcode', $barcode, $failCallback);

        $this->assertTrue($failCalled, "Validation should fail for {$barcode}");
        $this->assertNotNull($failMessage, 'Fail message should be set');
    }

    /**
     * Provide valid barcodes for testing.
     */
    public static function validBarcodeProvider(): array
    {
        return [
            'Valid EAN-8' => ['96385074'],
            'Valid UPC-A' => ['042100005264'],
            'Valid EAN-13' => ['5901234123457'],
        ];
    }

    /**
     * Provide invalid barcodes for testing.
     */
    public static function invalidBarcodeProvider(): array
    {
        return [
            'Invalid format (contains letters)' => ['ABC12345'],
            'Invalid length (9 digits)' => ['123456789'],
            'Invalid check digit' => ['5901234123458'],
            'Empty string' => [''],
            'Too short' => ['123456'],
        ];
    }
}
