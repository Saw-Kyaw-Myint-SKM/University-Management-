<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('faculties',   FacultyController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('courses',     CourseController::class);
        Route::resource('teachers',    TeacherController::class);
        Route::resource('students',    StudentController::class);
        Route::resource('admissions',  AdmissionController::class);
        Route::resource('enrollments', EnrollmentController::class);
        Route::resource('exams',       ExamController::class);
        Route::resource('results',     ExamResultController::class);
        Route::resource('attendance',  AttendanceController::class);
    });

    // Notifications (all roles)
    Route::resource('notifications', NotificationController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
});

require __DIR__.'/auth.php';
