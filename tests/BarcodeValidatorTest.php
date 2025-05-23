<?php

use Cpuch\BarcodeValidator\BarcodeValidator;

it('validates a correct EAN-8 barcode', function () {
    expect(BarcodeValidator::validate('96385074'))->toBeTrue();
});

it('validates a correct UPC-A barcode', function () {
    expect(BarcodeValidator::validate('036000291452'))->toBeTrue();
});

it('validates a correct EAN-13 barcode', function () {
    expect(BarcodeValidator::validate('5901234123457'))->toBeTrue();
});

it('invalidates an incorrect EAN-8 barcode', function () {
    expect(BarcodeValidator::validate('96385075'))->toBeFalse();
});

it('invalidates an incorrect UPC-A barcode', function () {
    expect(BarcodeValidator::validate('036000291453'))->toBeFalse();
});

it('invalidates an incorrect EAN-13 barcode', function () {
    expect(BarcodeValidator::validate('5901234123458'))->toBeFalse();
});

it('invalidates a barcode with non-numeric characters', function () {
    expect(BarcodeValidator::validate('590123412345A'))->toBeFalse();
});

it('invalidates a barcode with incorrect length', function () {
    expect(BarcodeValidator::validate('590123412345'))->toBeFalse();
    expect(BarcodeValidator::validate('59012341234567'))->toBeFalse();
});
