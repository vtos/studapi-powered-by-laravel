<?php

namespace Tests\Functional;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TruncateCollection;

final class CreateStudentTest extends TestCase
{
    use TruncateCollection;

    /**
     * @test
     */
    public function student_can_be_created(): void
    {
        $SIN = 145745;

        $response = $this->postJson('/api/students',
            [
                'sin' => $SIN,
                'active' => true,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        );
        $response->assertStatus(Response::HTTP_CREATED);

        $response = $this->getJson("/api/students/$SIN");
        $response->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
            [
                'sin' => $SIN,
                'active' => true,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        );
    }
}
