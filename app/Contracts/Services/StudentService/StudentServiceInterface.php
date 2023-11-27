<?php

namespace App\Contracts\Services\StudentService;

interface StudentServiceInterface
{
    public function get($id = null);

    public function create($student);

    public function delete($id);
}
