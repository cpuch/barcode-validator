# Barcode Validator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cpuch/barcode-validator.svg?style=flat-square)](https://packagist.org/packages/cpuch/barcode-validator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cpuch/barcode-validator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cpuch/barcode-validator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cpuch/barcode-validator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cpuch/barcode-validator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cpuch/barcode-validator.svg?style=flat-square)](https://packagist.org/packages/cpuch/barcode-validator)

Simple validator to check for correctly formatted UPC or EAN barcodes.

## Installation

You can install the package via composer:

```bash
composer require cpuch/barcode-validator
```

## Usage

In a controller you can use the class as a validator rule like this :

```php
use Cpuch\BarcodeValidator\BarcodeValidator\BarcodeValidatorRule;

$request->validate([
    'barcode' => ['required', new BarcodeValidatorRule],
]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
