# sbooker/litgroup-enumerable-normalizer

[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![PHP Version][badge-php]][php]
[![Total Downloads][badge-downloads]][downloads]

The sbooker/litgroup-enumerable-normalizer package provides the ability to normalize/denormalize 
[litgroup/enumerable][litgroup-enumerable] with [Symfony serializer][symfony-serializer].

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run
the following command to install the package and add it as a requirement to
your project's `composer.json`:

```bash
composer require sbooker/litgroup-enumerable-normalizer
```

## Examples

```php
// Declare Enum 

use LitGroup\Enumerable\Enumerable;

final class ColorEnum extends Enumerable
{
    /**
     * @return self
     */
    public static function red()
    {
        return self::createEnum('red');
    }

    /**
     * @return self
     */
    public static function green()
    {
        return self::createEnum('green');
    }

    /**
     * @return self
     */
    public static function blue()
    {
        return self::createEnum('blue');
    }
}

// Configure Symfony serializer
$serializer = new Symfony\Component\Serializer\Serializer([
    new \Sbooker\LitGroupEnumerable\Normalizer\EnumerableNormalizer(),
]);

// Normalize enum
$normalized = $serializer->normalize(ColorEnum::red()); // $normalized === 'red'
```

## License
See [LICENSE][license] file.

[badge-release]: https://img.shields.io/packagist/v/sbooker/litgroup-enumerable-normalizer.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/sbooker/litgroup-enumerable-normalizer.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/sbooker/litgroup-enumerable-normalizer.svg?style=flat-square

[release]: https://img.shields.io/packagist/v/sbooker/litgroup-enumerable-normalizer
[license]: https://github.com/sbooker/litgroup-enumerable-normalizer/blob/master/LICENSE
[php]: https://php.net
[downloads]: https://packagist.org/packages/sbooker/litgroup-enumerable-normalizer

[litgroup-enumerable]: https://github.com/LitGroup/enumerable.php
[symfony-serializer]: https://symfony.com/doc/current/components/serializer.html#normalizers
[packagist]: https://packagist.org/packages/ramsey/uuid-doctrine
[composer]: http://getcomposer.org/
[doctrine-getting-started]: https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html

