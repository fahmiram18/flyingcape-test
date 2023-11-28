<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum', 'checkPermission')->group(function (){
    Route::prefix('/classroom')->group(function (){
        Route::get('/', [\App\Http\Controllers\ClassroomController::class, 'get'])->name('classroom.get');
        Route::get('/get-by-teacher', [\App\Http\Controllers\ClassroomController::class, 'getClassroomByTeacher'])->name('classroom.get.by-teacher');
        Route::get('/get-by-student', [\App\Http\Controllers\ClassroomController::class, 'getClassroomByStudent'])->name('classroom.get.by-student');
        Route::post('/', [\App\Http\Controllers\ClassroomController::class, 'store'])->name('classroom.store');
        Route::post('/enroll-student', [\App\Http\Controllers\ClassroomController::class, 'enrollStudent'])->name('classroom.enroll-student');
        Route::delete('/', [\App\Http\Controllers\ClassroomController::class, 'destroy'])->name('classroom.delete');
        Route::delete('/disenroll-student', [\App\Http\Controllers\ClassroomController::class, 'disenrollStudent'])->name('classroom.disenroll-student');
    });

    Route::prefix('/teacher')->group(function (){
        Route::get('/', [\App\Http\Controllers\TeacherController::class, 'get'])->name('teacher.get');
        Route::post('/', [\App\Http\Controllers\TeacherController::class, 'store'])->name('teacher.store');
        Route::delete('/', [\App\Http\Controllers\TeacherController::class, 'destroy'])->name('teacher.delete');
    });

    Route::prefix('/student')->group(function (){
        Route::get('/', [\App\Http\Controllers\StudentController::class, 'get'])->name('student.get');
        Route::post('/', [\App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
        Route::delete('/', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.delete');
    });

    Route::prefix('/topic')->group(function (){
        Route::get('/', [\App\Http\Controllers\TopicController::class, 'get'])->name('topic.get');
        Route::get('/get-by-classroom', [\App\Http\Controllers\TopicController::class, 'getTopicByClassroom'])->name('topic.get.by-classroom');
        Route::post('/', [\App\Http\Controllers\TopicController::class, 'store'])->name('topic.store');
        Route::delete('/', [\App\Http\Controllers\TopicController::class, 'destroy'])->name('topic.delete');
    });

    Route::prefix('/comment')->group(function (){
        Route::get('/', [\App\Http\Controllers\CommentController::class, 'get'])->name('comment.get');
        Route::get('/get-by-topic', [\App\Http\Controllers\CommentController::class, 'getCommentByTopic'])->name('comment.get.by-topic');
        Route::post('/', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    });
});
