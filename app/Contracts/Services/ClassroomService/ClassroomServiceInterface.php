<?php

namespace App\Contracts\Services\ClassroomService;

interface ClassroomServiceInterface
{
    public function get($id = null);

    public function getClassroomByTeacher($teacher_id);

    public function getClassroomByStudent($student_id);

    public function create($classroom);

    public function checkEnrolledStudent($data);

    public function checkDisenrolledStudent($data);

    public function enrollStudent($data);

    public function disenrollStudent($classroomstudent_id);

    public function delete($id);
}
