<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Value;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\StudentName;

final class StudentNameTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_to_instantiate_with_empty_first_name(): void
    {
        $this->expectExceptionMessage('Student first name cannot be empty.');
        StudentName::fromStrings('', '', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_empty_first_name_when_no_second_name(): void
    {
        $this->expectExceptionMessage('Student first name cannot be empty.');
        StudentName::fromStringsWithNoSecondName('', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_meaningless_first_name(): void
    {
        $this->expectExceptionMessage('Student first name cannot be empty.');
        StudentName::fromStrings('       ', '', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_meaningless_first_name_when_no_second_name(): void
    {
        $this->expectExceptionMessage('Student first name cannot be empty.');
        StudentName::fromStringsWithNoSecondName('', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_empty_last_name(): void
    {
        $this->expectExceptionMessage('Student last name cannot be empty.');
        StudentName::fromStringsWithNoSecondName('John', '', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_empty_last_name_when_no_second_name(): void
    {
        $this->expectExceptionMessage('Student last name cannot be empty.');
        StudentName::fromStringsWithNoSecondName('John', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_meaningless_last_name(): void
    {
        $this->expectExceptionMessage('Student last name cannot be empty.');
        StudentName::fromStrings('John', '           ', '');
    }

    /**
     * @test
     */
    public function it_fails_to_instantiate_with_meaningless_last_name_when_no_second_name(): void
    {
        $this->expectExceptionMessage('Student last name cannot be empty.');
        StudentName::fromStringsWithNoSecondName('John', '      ');
    }

    /**
     * @test
     */
    public function it_can_be_converted_to_string_when_no_second_name(): void
    {
        $name = StudentName::fromStringsWithNoSecondName('John', 'Doe');
        $this->assertEquals('Doe John', $name->asString());
    }

    /**
     * @test
     */
    public function it_can_be_converted_to_string(): void
    {
        $name = StudentName::fromStrings('John', 'Doe', 'Smith');
        $this->assertEquals('Doe John Smith', $name->asString());
    }
}
