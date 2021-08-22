<?php

declare(strict_types=1);

namespace App\Casts;

use InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Domain\Value\GroupName as GroupNameValue;

class GroupName implements CastsAttributes, SerializesCastableAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param string $value
     * @param array $attributes
     * @return GroupNameValue
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return GroupNameValue::fromString($value);
    }

    /**
     * @param Model $model
     * @param string $key
     * @param GroupNameValue $value
     * @param array $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (! $value instanceof GroupNameValue) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expected instance of %s to cast.',
                    GroupNameValue::class
                )
            );
        }

        return $value->asString();
    }

    /**
     * @param Model $model
     * @param string $key
     * @param GroupNameValue $value
     * @param array $attributes
     * @return string
     */
    public function serialize($model, string $key, $value, array $attributes)
    {
        return $value->asString();
    }
}
