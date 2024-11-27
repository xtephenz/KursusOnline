<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
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
Route::get('/courses', [CourseController::class, 'viewCoursesPage'])->middleware('restrict.lecturer')->name('coursesPage.view');
Route::get('/course/add', [UserController::class, 'viewAddCoursePage'])->middleware('only.admin')->name('addCoursePage.view');
Route::post('/course/add', [CourseController::class, 'addNewCourse'])->name('addCoursePage.add');
Route::get('/course/detail/{course_id}/topic/{topic_id?}', [CourseController::class, 'viewCourseDetailPage'])->middleware('restrict.details')->name('courseDetailPage.view');

Route::get('/topic/{topic_id}/material/add', [MaterialController::class, 'viewAddMaterialPage'])->middleware('only.lecturer')->name('addMaterialPage.view');
Route::post('/topic/{topic_id}/material/add', [MaterialController::class, 'addNewMaterial'])->name('addMaterialPage.add');
Route::get('/download/material/{material_id}', [MaterialController::class, 'downloadMaterial'])->name('material.download');


Route::get('/course/detail/{course_id}/assignment', [CourseController::class, 'viewAssignmentTab'])->middleware('restrict.details')->name('courseDetailPage.assignment');
Route::get('/course/detail/{course_id}/student', [CourseController::class, 'viewStudentTab'])->middleware('restrict.details')->name('courseDetailPage.student');
Route::get('/courses/enroll/{course_id}', [CourseController::class, 'viewEnrollmentPage'])->name('enrollmentPage.view');
Route::post('/courses/enroll/{course_id}', [EnrollmentController::class, 'enrollToCourse'])->middleware('restrict.enroll')->name('enrollmentPage.enroll');
Route::get('/about-us', function () {return view('main.AboutUsPage');})->name('aboutUsPage.view');

Route::get('/profile/{user_id}', [UserController::class, 'viewProfilePage'])->name('profilePage.view');
Route::put('/profile/{user_id}', [UserController::class, 'updateProfile'])->name('profilePage.update');
Route::delete('/profile/{user_id}', [UserController::class, 'deletePhoto'])->name('profilePage.delete');
Route::get('/change-password', function () {return view('main.ChangePasswordPage');})->name('changePasswordPage.view');
Route::put('/change-password/{user_id}', [UserController::class, 'changePassword'])->name('changePasswordPage.update');