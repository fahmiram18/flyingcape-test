<?php

namespace App\Services\CommentService;

use App\Contracts\Services\CommentService\CommentServiceInterface;
use App\Models\Comment;

class CommentService implements CommentServiceInterface
{
    public function __construct(private readonly Comment $comment)
    {
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            return $this->comment->all();
        } else {
            return $this->comment->newQuery()->find($id);
        }
    }

    public function getCommentByTopic($topic_id)
    {
        return $this->comment->newQuery()
            ->where('topic_id', $topic_id)
            ->get();
    }

    public function create($comment)
    {
        $store = Comment::create([
            'topic_id' => $comment['topic_id'],
            'description' => $comment['description'],
            'created_by' => 4,
        ]);

        return $store;
    }
}
