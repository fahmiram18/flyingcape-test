<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TopicService\TopicServiceInterface;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct(private readonly TopicServiceInterface $service)
    {
    }

    public function get(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Topic not found'], 404);
        }
    }

    public function getTopicByClassroom(Request $request)
    {
        $id = $request->classroom_id;

        $data = $this->service->getTopicByClassroom($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Classroom not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['classroom_id'])) {
            return response(['message' => 'Classroom must be selected']);
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

    public function destroy(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if (!$data or is_null($id)) {
            return response(['message' => 'Topic not found'], 404);
        }

        $delete = $this->service->delete($id);

        if ($delete) {
            return response(['message' => 'Successfully deleted'], 200);
        } else {
            return response(['message' => 'Data not deleted'], 422);
        }
    }
}
