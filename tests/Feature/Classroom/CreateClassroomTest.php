<?php

namespace Classroom;

use Illuminate\Support\Str;
use Tests\TestCase;

class CreateClassroomTest extends TestCase
{
    private $apiUri = "api/classroom";

    public function test_create_classroom_success(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
            'name' => Str::random(10),
            'teacher_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_create_classroom_teacher_not_found(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'name' => Str::random(10),
                'teacher_id' => 99
            ]);

        $response->assertStatus(422);
    }

    public function test_create_classroom_name_is_empty(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'name' => '',
                'teacher_id' => 1
            ]);

        $response->assertStatus(422);
    }

    public function test_create_classroom_teacher_not_selected(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'name' => Str::random(10),
                'teacher_id' => 0
            ]);

        $response->assertStatus(422);
    }
}
