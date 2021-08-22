<?php

declare(strict_types=1);

namespace App\Casts;

use InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Domain\Value\StudentName as StudentNameValue;

class StudentName implements CastsAttributes, SerializesCastableAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return StudentNameValue
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return isset($attributes['second_name'])
            ? StudentNameValue::fromStrings(
                $attributes['first_name'],
                $attributes['last_name'],
                $attributes['second_name']
            )
            : StudentNameValue::fromStringsWithNoSecondName($attributes['first_name'], $attributes['last_name']);
    }

    /**
     * @param Model $model
     * @param string $key
     * @param StudentNameValue $value
     * @param array $attributes
     * @return array
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (! $value instanceof StudentNameValue) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expected instance of %s to cast.',
                    StudentNameValue::class
                )
            );
        }

        $return = [
            'first_name' => $value->firstName(),
            'last_name' => $value->lastName(),
        ];
        if (!empty($value->secondName())) {
            $return['second_name'] = $value->secondName();
        }

        return $return;
    }

    /**
     * @param Model $model
     * @param string $key
     * @param StudentNameValue $value
     * @param array $attributes
     * @return string
     */
    public function serialize($model, string $key, $value, array $attributes)
    {
        return $value->asString();
    }
}
