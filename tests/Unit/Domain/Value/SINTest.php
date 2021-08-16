<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Value;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\SIN;

final class SINTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_to_instantiate_from_a_negative_integer(): void
    {
        $this->expectExceptionMessage('SIN must be a number greater than 0.');
        SIN::fromInt(-45);
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_from_zero(): void
    {
        $this->expectExceptionMessage('SIN must be a number greater than 0.');
        SIN::fromInt(0);
    }

    /**
     * @test
     */
    public function it_can_be_converted_to_an_integer(): void
    {
        $sin = SIN::fromInt(457811);
        $this->assertEquals(457811, $sin->asInt());
    }
}
