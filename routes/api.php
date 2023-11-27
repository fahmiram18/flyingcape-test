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

Route::prefix('/classroom')->group(function (){
    Route::get('/', [\App\Http\Controllers\ClassroomController::class, 'get'])->name('classroom.get');
    Route::post('/', [\App\Http\Controllers\ClassroomController::class, 'store'])->name('classroom.store');
    Route::post('/enroll-student', [\App\Http\Controllers\ClassroomController::class, 'enrollStudent'])->name('classroom.enroll-student');
    Route::delete('/disenroll-student', [\App\Http\Controllers\ClassroomController::class, 'disenrollStudent'])->name('classroom.disenroll-student');
    Route::delete('/', [\App\Http\Controllers\ClassroomController::class, 'destroy'])->name('classroom.delete');
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
