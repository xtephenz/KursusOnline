<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CourseController::class, 'viewHomePage'])->middleware('restrict.admin:1')->name('homePage.view');
Route::get('/registration', [UserController::class, 'viewRegisterPage'])->middleware('logged.in')->name('registerPage.view');
Route::post('/register', [UserController::class, 'register'])->name('registerPage.register');
Route::get('/login', function(){return view('main.LoginPage');})->middleware('logged.in')->name('loginPage.view');
Route::post('/login', [UserController::class, 'login'])->name('loginPage.login');
Route::get('/logout', [UserController::class, 'logout'])->name('loginPage.logout');
Route::get('/courses', [CourseController::class, 'viewCoursesPage'])->name('coursesPage.view');
Route::get('/course/detail/{course_id}/topic/{topic_id?}', [CourseController::class, 'viewCourseDetailPage'])->middleware('restrict.details')->name('courseDetailPage.view');
Route::get('/course/detail/{course_id}/assignment', [CourseController::class, 'viewAssignmentTab'])->middleware('restrict.details')->name('courseDetailPage.assignment');
Route::get('/course/detail/{course_id}/student', [CourseController::class, 'viewStudentTab'])->middleware('restrict.details')->name('courseDetailPage.student');
Route::get('/courses/enroll/{course_id}', [CourseController::class, 'viewEnrollmentPage'])->name('enrollmentPage.view');
Route::post('/courses/enroll/{course_id}', [CourseController::class, 'enrollToCourse'])->middleware('restrict.enroll')->name('enrollmentPage.enroll');
Route::get('/about-us', function () {return view('main.AboutUsPage');})->name('aboutUsPage.view');