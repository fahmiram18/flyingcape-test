<?php

namespace Tests\Feature\User\Teacher;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateStudentTest extends TestCase
{
    private $apiUri = "api/student";

    public function test_create_student_success(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'firstname' => Str::random(5),
                'surname' => Str::random(5),
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(200);
    }

    public function test_create_student_firstname_is_empty(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'firstname' => '',
                'surname' => Str::random(5),
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_student_surname_is_empty(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'firstname' => Str::random(5),
                'surname' => '',
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_student_email_is_empty(): void
    {
        $token = $this->login('admin@flyingcape.com.sg', 'admin123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'firstname' => Str::random(5),
                'surname' => Str::random(5),
                'email' => '',
            ]);

        $response->assertStatus(422);
    }
}
