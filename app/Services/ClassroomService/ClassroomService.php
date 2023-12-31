<?php

namespace App\Services\ClassroomService;

use App\Contracts\Services\ClassroomService\ClassroomServiceInterface;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

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

    public function getClassroomByTeacher($teacher_id)
    {
        return $this->classroom->newQuery()
            ->where('teacher_id', $teacher_id)
            ->get();
    }

    public function getClassroomByStudent($student_id)
    {
        $data = Classroom::whereHas('classroomStudents', function ($query) use ($student_id){
            $query->where('student_id', $student_id);
        })
            ->get();

        return $data;
    }

    public function create($classroom)
    {
        $store = Classroom::create([
            'name' => $classroom['name'],
            'teacher_id' => $classroom['teacher_id'],
            'created_by' => \auth()->id(),
        ]);

        return $store;
    }

    public function enrollStudent($data)
    {
        $store = ClassroomStudent::create([
            'classroom_id' => $data['classroom_id'],
            'student_id' => $data['student_id'],
            'assigned_by' => \auth()->id(),
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

    public function checkClassroom($id)
    {
        $data = Teacher::where('id', $id)->first();

        return $data;
    }

    public function checkTeacher($id)
    {
        $data = Teacher::where('id', $id)->first();

        return $data;
    }

    public function checkStudent($id)
    {
        $data = Student::where('id', $id)->first();

        return $data;
    }
}
