<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\MassAssignmentException;
use App\Models\Student;
use App\Domain\Value\SIN;
use App\Domain\Value\StudentName;
use App\Domain\Value\GroupName;

class StudentTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_when_assigned_other_than_a_value_object_for_the_sin_attribute(): void
    {
        $student = new Student();

        $this->expectExceptionMessage(
            sprintf(
                'Expected instance of %s to cast.',
                SIN::class
            )
        );
        $student->sin = 487545;
    }

    /**
     * @test
     */
    public function it_fails_when_assigned_other_than_a_value_object_for_the_name_attribute(): void
    {
        $student = new Student();

        $this->expectExceptionMessage(
            sprintf(
                'Expected instance of %s to cast.',
                StudentName::class
            )
        );
        $student->name = 'John Doe';
    }

    /**
     * @test
     */
    public function it_fails_when_assigned_other_than_a_value_object_for_the_group_name_attribute(): void
    {
        $student = new Student();

        $this->expectExceptionMessage(
            sprintf(
                'Expected instance of %s to cast.',
                GroupName::class
            )
        );
        $student->group_name = 'MATH101';
    }

    /**
     * @test
     */
    public function it_has_value_objects_as_attributes_values_where_required(): void
    {
        $SIN = 487558;
        $firstName = 'John';
        $lastName = 'Doe';
        $secondName = 'Smith';
        $groupName = 'MATH101';

        $student = new Student();
        $student->sin = SIN::fromInt($SIN);
        $student->name = StudentName::fromStringsWithNoSecondName($firstName, $lastName);
        $student->group_name = GroupName::fromString($groupName);
        $student->active = true;


        $this->assertEquals(
            SIN::fromInt($SIN),
            $student->sin
        );
        $this->assertEquals(
            StudentName::fromStringsWithNoSecondName($firstName, $lastName),
            $student->name
        );
        $this->assertEquals(
            GroupName::fromString($groupName),
            $student->group_name
        );
        $this->assertTrue($student->active);

        $student->name = StudentName::fromStrings($firstName, $lastName, $secondName);
        $this->assertEquals(
            StudentName::fromStrings($firstName, $lastName, $secondName),
            $student->name
        );
    }

    /**
     * @test
     */
    public function it_does_not_allow_for_filling_the_sin_attribute(): void
    {
        $student = new Student();

        $this->expectException(MassAssignmentException::class);
        $student->fill(
            [
                'sin' => SIN::fromInt(941745),
            ]
        );
    }

    /**
     * @test
     */
    public function it_does_not_allow_for_filling_the_name_attribute(): void
    {
        $student = new Student();

        $this->expectException(MassAssignmentException::class);
        $student->fill(
            [
                'name' => StudentName::fromStringsWithNoSecondName('John', 'Doe'),
            ]
        );
    }

    /**
     * @test
     */
    public function it_does_not_allow_for_filling_the_group_name_attribute(): void
    {
        $student = new Student();

        $this->expectException(MassAssignmentException::class);
        $student->fill(
            [
                'group_name' => GroupName::fromString('MATH101'),
            ]
        );
    }
}
