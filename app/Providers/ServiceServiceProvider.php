<?php

namespace App\Providers;

use App\Contracts\Services\ClassroomService\ClassroomServiceInterface;
use App\Contracts\Services\CommentService\CommentServiceInterface;
use App\Contracts\Services\StudentService\StudentServiceInterface;
use App\Contracts\Services\TeacherService\TeacherServiceInterface;
use App\Contracts\Services\TopicService\TopicServiceInterface;
use App\Services\ClassroomService\ClassroomService;
use App\Services\CommentService\CommentService;
use App\Services\StudentService\StudentService;
use App\Services\TeacherService\TeacherService;
use App\Services\TopicService\TopicService;
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

        $this->app->bind(
            TopicServiceInterface::class,
            TopicService::class
        );

        $this->app->bind(
            CommentServiceInterface::class,
            CommentService::class
        );
    }
}
