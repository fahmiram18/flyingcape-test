<?php

namespace Tests\Feature\Comment;

use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    private $apiUri = "api/comment";

    private function _createTopic(){
        $classroom = $this->createClassroom();

        $store = Topic::create([
            'classroom_id' => $classroom->id,
            'description' => Str::random(15),
            'created_by' => 2,
        ]);

        return $store;
    }

    public function test_create_comment_success(): void
    {
        $topic = $this->_createTopic();

        $token = $this->login('jimmydoe@mail.com', 'student123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'topic_id' => $topic->id,
                'description' => Str::random(15),
            ]);

        $response->assertStatus(200);
    }

    public function test_create_comment_topic_not_found(): void
    {
        $token = $this->login('jimmydoe@mail.com', 'student123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'topic_id' => 99,
                'description' => Str::random(15),
            ]);

        $response->assertStatus(422);
    }

    public function test_create_comment_topic_is_empty(): void
    {
        $token = $this->login('jimmydoe@mail.com', 'student123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'topic_id' => 0,
                'description' => Str::random(15),
            ]);

        $response->assertStatus(422);
    }

    public function test_create_comment_description_is_empty(): void
    {
        $topic = $this->_createTopic();

        $token = $this->login('jimmydoe@mail.com', 'student123');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->postJson($this->apiUri, [
                'topic_id' => $topic->id,
                'description' => '',
            ]);

        $response->assertStatus(422);
    }
}
