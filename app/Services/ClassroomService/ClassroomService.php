<?php

namespace App\Services\ClassroomService;

use App\Contracts\Services\ClassroomService\ClassroomServiceInterface;
use App\Models\Classroom;
use App\Models\ClassroomStudent;

class ClassroomService implements ClassroomServiceInterface
{
    public function __construct(private readonly Classroom $classroom)
    {
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            return $this->classroom->all();
        } else {
            return $this->classroom->newQuery()->find($id);
        }
    }

    public function create($classroom)
    {
        $store = Classroom::create([
            'name' => $classroom['name'],
            'teacher_id' => $classroom['teacher_id'],
            'created_by' => 1,
        ]);

        return $store;
    }

    public function enrollStudent($data)
    {
        $store = ClassroomStudent::create([
            'classroom_id' => $data['classroom_id'],
            'student_id' => $data['student_id'],
            'assigned_by' => 1,
        ]);

        return $store;
    }

    public function disenrollStudent($classroomstudent_id)
    {
        $delete = ClassroomStudent::where('id', $classroomstudent_id)->delete();

        return $delete;
    }

    public function delete($id)
    {
        $delete = Classroom::where('id', $id)->delete();

        return $delete;
    }

    public function checkEnrolledStudent($data)
    {
        $data = ClassroomStudent::where([
            'classroom_id' => $data['classroom_id'],
            'student_id' => $data['student_id'],
        ])->first();

        return $data;
    }

    public function checkDisenrolledStudent($classroomstudent_id)
    {
        $data = ClassroomStudent::where('id', $classroomstudent_id)->first();

        return $data;
    }
}
