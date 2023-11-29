<?php

namespace Tests\Feature\Topic;

use Illuminate\Support\Str;
use Tests\TestCase;

class CreateTopicTest extends TestCase
{
    private $apiUri = "api/topic";

    public function test_create_topic_success(): void
    {
        $classroom = $this->createClassroom();

        $token = $this->login('johndoe@mail.com', 'teacher123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => $classroom->id,
                'description' => Str::random(15),
            ]);

        $response->assertStatus(200);
    }

    public function test_create_topic_classroom_not_found(): void
    {
        $token = $this->login('johndoe@mail.com', 'teacher123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' =>99,
                'description' => Str::random(15),
            ]);

        $response->assertStatus(422);
    }

    public function test_create_topic_classroom_is_empty(): void
    {

        $token = $this->login('johndoe@mail.com', 'teacher123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => 0,
                'description' => '',
            ]);

        $response->assertStatus(422);
    }

    public function test_create_topic_description_is_empty(): void
    {
        $classroom = $this->createClassroom();

        $token = $this->login('johndoe@mail.com', 'teacher123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'classroom_id' => $classroom->id,
                'description' => '',
            ]);

        $response->assertStatus(422);
    }
}
