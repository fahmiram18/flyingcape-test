<?php

namespace App\Contracts\Services\TeacherService;

interface TeacherServiceInterface
{
    public function get($id = null);

    public function create($teacher);

    public function delete($id);
}
