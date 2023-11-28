<?php

namespace App\Services\StudentService;

use App\Contracts\Services\StudentService\StudentServiceInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentService implements StudentServiceInterface
{
    public function __construct(private readonly Student $student)
    {
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            return $this->student->all();
        } else {
            return $this->student->newQuery()->find($id);
        }
    }

    public function create($student)
    {
        $store = Student::create([
            'firstname' => $student['firstname'],
            'surname' => $student['surname'],
        ]);

        if ($store) {
            $user = User::create([
                'username' => strtolower($student['firstname']).strtolower($student['surname']),
                'email' => $student['email'],
                'password' => Hash::make('student123'),
                'role_id' => 3,
                'parent_id' => $store->id
            ]);

            $user->createToken('studenttoken')->plainTextToken;
        }

        return $store;
    }

    public function delete($id)
    {
        $delete = Student::where('id', $id)->delete();

        return $delete;
    }
}
