<?php

namespace App\Http\Controllers;

use App\Contracts\Services\StudentService\StudentServiceInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(private readonly StudentServiceInterface $service)
    {
    }

    public function get(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Student not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['firstname'])) {
            return response(['message' => 'First Name must be filled']);
        }

        if (empty($data['surname'])) {
            return response(['message' => 'Surname must be filled']);
        }

        if (empty($data['email'])) {
            return response(['message' => 'E-mail must be filled']);
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
            return response(['message' => 'Student not found'], 404);
        }

        $delete = $this->service->delete($id);

        if ($delete) {
            return response(['message' => 'Successfully deleted'], 200);
        } else {
            return response(['message' => 'Data not deleted'], 422);
        }
    }
}
