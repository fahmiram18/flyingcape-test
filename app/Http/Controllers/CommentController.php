<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentService\CommentServiceInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private readonly CommentServiceInterface $service)
    {
    }

    public function get(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Comment not found'], 404);
        }
    }

    public function getCommentByTopic(Request $request)
    {
        $id = $request->topic_id;

        $data = $this->service->getCommentByTopic($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Topic not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['topic_id'])) {
            return response(['message' => 'Topic must be selected']);
        }

        if (empty($data['description'])) {
            return response(['message' => 'Description must be filled']);
        }

        $store = $this->service->create($data);

        if ($store) {
            return response(['message' => 'Successfully saved'], 200);
        } else {
            return response(['message' => 'Data not saved'], 422);
        }
    }
}
