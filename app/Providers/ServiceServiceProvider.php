<?php

namespace App\Providers;

use App\Contracts\Services\ClassroomService\ClassroomServiceInterface;
use App\Contracts\Services\StudentService\StudentServiceInterface;
use App\Contracts\Services\TeacherService\TeacherServiceInterface;
use App\Services\ClassroomService\ClassroomService;
use App\Services\StudentService\StudentService;
use App\Services\TeacherService\TeacherService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            ClassroomServiceInterface::class,
            ClassroomService::class
        );

        $this->app->bind(
            TeacherServiceInterface::class,
            TeacherService::class
        );

        $this->app->bind(
            StudentServiceInterface::class,
            StudentService::class
        );
    }
}
