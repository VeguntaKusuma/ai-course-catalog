<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserCourseController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [CourseController::class, 'dashboard'])
        ->name('dashboard');
        Route::resource('courses', CourseController::class);
        Route::get('/enrollments', [EnrollmentController::class, 'index'])
            ->name('enrollments.index');
    });

});

Route::get('/courses', [UserCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/search', [UserCourseController::class, 'search'])->name('courses.search');
Route::get('/courses/{id}', [UserCourseController::class, 'show'])->name('courses.show');
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');

Route::get('/', function () {
    return view('user.home');
})->name('home');

// Route::get('/admin/dashboard', [App\Http\Controllers\Admin\CourseController::class, 'dashboard'])
//     ->name('admin.dashboard')
//     ->middleware('auth');