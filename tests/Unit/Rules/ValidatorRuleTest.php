<?php

namespace Tests\Unit\Rules;

use Cpuch\BarcodeValidator\Rules\BarcodeValidatorRule;
use Orchestra\Testbench\TestCase;

// use PHPUnit\Framework\TestCase;

class ValidatorRuleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        // Ajoute ton service provider pour charger les traductions
        return [
            \Cpuch\BarcodeValidator\BarcodeValidatorServiceProvider::class,
        ];
    }

    /**
     * Test validation of valid barcodes.
     */
    public function test_valid_barcodes_pass()
    {
        foreach (self::validBarcodeProvider() as $barcode) {
            $rule = new BarcodeValidatorRule;

            $failCalled = false;
            $failCallback = function () use (&$failCalled) {
                $failCalled = true;

                return 'Error message';
            };

            $rule->validate('barcode', $barcode[0], $failCallback);

            $this->assertFalse($failCalled, "Validation should pass for {$barcode[0]}");
        }
    }

    /**
     * Test validation of invalid barcodes.
     */
    public function test_valid_barcodes_fail()
    {
        foreach (self::invalidBarcodeProvider() as $barcode) {
            $rule = new BarcodeValidatorRule;

            $failCalled = false;
            $failMessage = null;
            $failCallback = function ($message) use (&$failCalled, &$failMessage) {
                $failCalled = true;
                $failMessage = $message;

                return $message;
            };

            $rule->validate('barcode', $barcode[0], $failCallback);

            $this->assertTrue($failCalled, "Validation should fail for {$barcode[0]}");
            $this->assertNotNull($failMessage, 'Fail message should be set');
        }
    }

    /**
     * Provide valid barcodes for testing.
     */
    public static function validBarcodeProvider(): array
    {
        return [
            ['96385074'],         // Valid EAN-8
            ['042100005264'],     // Valid UPC-A
            ['5901234123457'],    // Valid EAN-13
        ];
    }

    /**
     * Provide invalid barcodes for testing.
     */
    public static function invalidBarcodeProvider(): array
    {
        return [
            ['ABC12345'],         // Invalid format (contains letters)
            ['123456789'],        // Invalid length (9 digits)
            ['5901234123458'],    // Invalid check digit
            [''],                 // Empty string
            ['123456'],           // Too short
        ];
    }
}
