<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Domain\Value\SIN as SINValue;

final class SIN implements CastsAttributes, SerializesCastableAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param int $value
     * @param array $attributes
     * @return SINValue
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return SINValue::fromInt($value);
    }

    /**
     * @param Model $model
     * @param string $key
     * @param SINValue $value
     * @param array $attributes
     * @return int
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (! $value instanceof SINValue) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expected instance of %s to cast.',
                    SINValue::class
                )
            );
        }

        return $value->asInt();
    }

    /**
     * @param Model $model
     * @param string $key
     * @param SINValue $value
     * @param array $attributes
     * @return int
     */
    public function serialize($model, string $key, $value, array $attributes)
    {
        return $value->asInt();
    }
}
