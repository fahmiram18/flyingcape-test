<?php

namespace App\Contracts\Services\TopicService;

interface TopicServiceInterface
{
    public function get($id = null);

    public function getTopicByClassroom($classroom_id);

    public function create($topic);

    public function delete($id);
}
