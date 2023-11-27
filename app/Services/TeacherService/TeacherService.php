<?php

namespace App\Services\TeacherService;

use App\Contracts\Services\TeacherService\TeacherServiceInterface;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherService implements TeacherServiceInterface
{
    public function __construct(private readonly Teacher $teacher)
    {
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            return $this->teacher->all();
        } else {
            return $this->teacher->newQuery()->find($id);
        }
    }

    public function create($teacher)
    {
        $store = Teacher::create([
            'firstname' => $teacher['firstname'],
            'surname' => $teacher['surname'],
            'expertise' => $teacher['expertise'],
        ]);

        if ($store) {
            User::create([
                'username' => strtolower($teacher['firstname']).strtolower($teacher['surname']),
                'email' => $teacher['email'],
                'password' => Hash::make('teacher123'),
                'role_id' => 2,
                'parent_id' => $store->id
            ]);
        }

        return $store;
    }

    public function delete($id)
    {
        $delete = Teacher::where('id', $id)->delete();

        return $delete;
    }
}
