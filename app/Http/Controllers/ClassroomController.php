<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ClassroomService\ClassroomServiceInterface;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(private readonly ClassroomServiceInterface $service)
    {
    }

    public function get(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Classroom not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['name'])) {
            return response(['message' => 'Classroom Name must be filled']);
        }

        if (empty($data['teacher_id'])) {
            return response(['message' => 'Teacher must be selected']);
        }

        $store = $this->service->create($data);

        if ($store) {
            return response(['message' => 'Successfully saved'], 200);
        } else {
            return response(['message' => 'Data not saved'], 422);
        }
    }

    public function enrollStudent(Request $request)
    {
        $data = $request->all();

        if (empty($data['classroom_id'])) {
            return response(['message' => 'Classroom must be selected']);
        }

        if (empty($data['student_id'])) {
            return response(['message' => 'Student must be selected']);
        }

        if ($this->service->checkEnrolledStudent($data)) {
            return response(['message' => 'This student was enrolled this class'], 422);
        }

        $store = $this->service->enrollStudent($data);

        if ($store) {
            return response(['message' => 'Successfully enrolled'], 200);
        } else {
            return response(['message' => 'Failed to enroll student'], 422);
        }
    }

    public function disenrollStudent(Request $request)
    {
        $classroomstudent_id = $request->classroomstudent_id;

//        if (empty($data['classroomstudent_id'])) {
//            return response(['message' => 'Student Classroom must be selected']);
//        }

        if (!$this->service->checkDisenrolledStudent($classroomstudent_id)) {
            return response(['message' => 'This student not enrolled this class'], 422);
        }

        $store = $this->service->disenrollStudent($classroomstudent_id);

        if ($store) {
            return response(['message' => 'Successfully disenrolled'], 200);
        } else {
            return response(['message' => 'Failed to disenroll student'], 422);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $data = $this->service->get($id);

        if (!$data or is_null($id)) {
            return response(['message' => 'Classroom not found'], 404);
        }

        $delete = $this->service->delete($id);

        if ($delete) {
            return response(['message' => 'Successfully deleted'], 200);
        } else {
            return response(['message' => 'Data not deleted'], 422);
        }
    }
}
