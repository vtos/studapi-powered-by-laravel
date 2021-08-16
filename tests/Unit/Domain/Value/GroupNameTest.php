<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Value;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\GroupName;

final class GroupNameTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_to_instantiate_from_an_empty_string(): void
    {
        $this->expectExceptionMessage('Student group name cannot be empty.');
        GroupName::fromString('');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_from_a_meaningless_string(): void
    {
        $this->expectExceptionMessage('Student group name cannot be empty.');
        GroupName::fromString('          ');
    }

    /**
     * @test
     */
    public function it_can_be_converted_to_string(): void
    {
        $name = GroupName::fromString('MATH101');
        $this->assertEquals('MATH101', $name->asString());
    }
}
