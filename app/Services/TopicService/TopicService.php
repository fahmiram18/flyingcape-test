<?php

namespace App\Services\TopicService;

use App\Contracts\Services\TopicService\TopicServiceInterface;
use App\Models\Topic;

class TopicService implements TopicServiceInterface
{
    public function __construct(private readonly Topic $topic)
    {
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            return $this->topic->all();
        } else {
            return $this->topic->newQuery()->find($id);
        }
    }

    public function getTopicByClassroom($classroom_id)
    {
        return $this->topic->newQuery()
            ->where('classroom_id', $classroom_id)
            ->get();
    }

    public function create($topic)
    {
        $store = Topic::create([
            'classroom_id' => $topic['classroom_id'],
            'description' => $topic['description'],
            'created_by' => 2,
        ]);

        return $store;
    }

    public function delete($id)
    {
        $delete = Topic::where('id', $id)->delete();

        return $delete;
    }
}
