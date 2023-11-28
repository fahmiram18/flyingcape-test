<?php

namespace App\Contracts\Services\CommentService;

interface CommentServiceInterface
{
    public function get($id = null);

    public function getCommentByTopic($topic_id);

    public function create($comment);
}
