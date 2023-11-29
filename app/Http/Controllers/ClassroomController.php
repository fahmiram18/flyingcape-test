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

    public function getClassroomByTeacher(Request $request)
    {
        $id = $request->teacher_id;

        $data = $this->service->getClassroomByTeacher($id);

        if ($data) {
            return response(['data' => $data], 200);
        } else {
            return response(['message' => 'Classroom not found'], 404);
        }
    }

    public function getClassroomByStudent(Request $request)
    {
        $id = $request->student_id;

        $data = $this->service->getClassroomByStudent($id);

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
            return response(['message' => 'Classroom Name must be filled'], 422);
        }

        if (empty($data['teacher_id'])) {
            return response(['message' => 'Teacher must be selected'], 422);
        }

        if(!$this->service->checkTeacher($data['teacher_id'])) {
            return response(['message' => 'Teacher not found'], 422);
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
            return response(['message' => 'Classroom must be selected'], 422);
        }

        if(!$this->service->get($data['classroom_id'])) {
            return response(['message' => 'Classroom not found'], 422);
        }

        if (empty($data['student_id'])) {
            return response(['message' => 'Student must be selected'], 422);
        }

        if(!$this->service->checkStudent($data['student_id'])) {
            return response(['message' => 'Student not found'], 422);
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
