<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final class SIN
{
    private int $number;

    /**
     * @param int $number
     */
    private function __construct(int $number)
    {
        Assert::positiveInteger($number, 'SIN must be a number greater than 0.');

        $this->number = $number;
    }

    public function asInt(): int
    {
        return $this->number;
    }

    public static function fromInt(int $number): self
    {
        return new self($number);
    }
}
