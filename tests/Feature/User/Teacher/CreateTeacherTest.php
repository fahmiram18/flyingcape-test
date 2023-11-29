<?php

namespace Tests\Feature\User\Teacher;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateTeacherTest extends TestCase
{
    private $apiUri = "api/teacher";

    public function test_create_teacher_success(): void
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
                'expertise' => Str::random(10),
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(200);
    }

    public function test_create_teacher_firstname_is_empty(): void
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
                'expertise' => Str::random(10),
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_teacher_surname_is_empty(): void
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
                'expertise' => Str::random(10),
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_teacher_expertise_is_empty(): void
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
                'expertise' => '',
                'email' => Str::random(10).'@mail.com',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_teacher_email_is_empty(): void
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
                'expertise' => Str::random(10),
                'email' => '',
            ]);

        $response->assertStatus(422);
    }
}
