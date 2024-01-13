<?php

namespace Sbooker\LitGroupEnumerable\Normalizer\Tests;

use LitGroup\Enumerable\Enumerable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Sbooker\LitGroupEnumerable\Normalizer\EnumerableNormalizer;
use Symfony\Component\Serializer\Serializer;

final class EnumerableNormalizerTest extends TestCase
{
    #[DataProvider('examples')]
    public function testNormalize(TestEnum $enum, string $expected): void
    {
        $serializer = $this->getSerializer();

        $given = $serializer->normalize($enum);

        $this->assertEquals($expected, $given);

    }

    #[DataProvider('examples')]
    public function testDenormalize(TestEnum $expected, string $value): void
    {
        $serializer = $this->getSerializer();

        $given = $serializer->denormalize($value, get_class($expected), 'json');

        $this->assertEquals($expected, $given);

    }

    public static function examples(): array
    {
        return [
            [TestEnum::A(), "A"],
            [TestEnum::B(), "B"],
        ];
    }

    private function getSerializer(): Serializer
    {
        return new Serializer([new EnumerableNormalizer()]);
    }
}

final class TestEnum extends Enumerable
{
    public static function A(): self
    {
        return self::createEnum('A');
    }

    public static function B(): self
    {
        return self::createEnum('B');
    }
}