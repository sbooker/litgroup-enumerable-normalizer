<?php

declare(strict_types=1);

namespace Sbooker\LitGroupEnumerable\Normalizer;

use LitGroup\Enumerable\Enumerable;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class EnumerableNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, string $format = null, array $context = [])
    {
        if (!$this->supportsNormalization($object)) {
            throw new \RuntimeException('Supports  only ' . Enumerable::class . ' normalization.');
        }

        return $object->getRawValue();
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Enumerable;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        /** @var Enumerable $type */
        return $type::getValueOf($data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return is_a($type, Enumerable::class, true) && $this->isValid($type, $data);
    }

    private function isValid(string $type, $data): bool
    {
        if (!is_string($data) && !is_int($data)) {
            return false;
        }

        try {
            /** @var Enumerable $type */
            $type::getValueOf($data);
            return true;
        } catch (\OutOfBoundsException $e) {
            return false;
        }
    }
}