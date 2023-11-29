<?php

namespace Classroom;

use App\Models\Classroom;
use Illuminate\Support\Str;
use Tests\TestCase;

class EnrollStudentTest extends TestCase
{
    private $apiUri = "api/classroom/enroll-student";

    public function test_enroll_student_to_classroom_success(): void
    {
        $classroom = $this->createClassroom();

        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => $classroom->id,
                'student_id' => 1,
                'assigned_by' => 1,
            ]);

        $response->assertStatus(200);
    }

    public function test_enroll_student_to_classroom_classroom_not_found(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => 99,
                'student_id' => 1,
                'assigned_by' => 1,
            ]);

        $response->assertStatus(422);
    }

    public function test_enroll_student_to_classroom_student_not_found(): void
    {
        $classroom = $this->createClassroom();

        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => $classroom->id,
                'student_id' => 99,
                'assigned_by' => 1,
            ]);

        $response->assertStatus(422);
    }

    public function test_enroll_student_to_classroom_classroom_is_empty(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => 0,
                'student_id' => 1,
                'assigned_by' => 1,
            ]);

        $response->assertStatus(422);
    }

    public function test_enroll_student_to_classroom_student_is_empty(): void
    {
        $classroom = $this->createClassroom();

        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => $classroom->id,
                'student_id' => 0,
                'assigned_by' => 1,
            ]);

        $response->assertStatus(422);
    }
}
