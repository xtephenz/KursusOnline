<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'viewHomePage'])->middleware('restrict.admin')->name('homePage.view');

Route::get('/registration', [UserController::class, 'viewRegisterPage'])->middleware('logged.in')->name('registerPage.view');
Route::post('/register', [UserController::class, 'register'])->name('registerPage.register');

Route::get('/login', function(){return view('main.LoginPage');})->middleware('logged.in')->name('loginPage.view');
Route::post('/login', [UserController::class, 'login'])->name('loginPage.login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('loginPage.logout');

Route::get('/courses', [CourseController::class, 'viewCoursesPage'])->middleware('restrict.lecturer')->name('coursesPage.view');

Route::get('/course/add', [UserController::class, 'viewAddCoursePage'])->middleware('only.admin')->name('addCoursePage.view');
Route::post('/course/add', [CourseController::class, 'addNewCourse'])->name('addCoursePage.add');

Route::get('/course/detail/{course_id}/topic/{topic_id?}', [CourseController::class, 'viewCourseDetailPage'])->middleware('auth')->name('courseDetailPage.view');
Route::get('/course/detail/{course_id}/assignment', [CourseController::class, 'viewAssignmentTab'])->middleware('auth')->name('courseDetailPage.assignment');
Route::get('/course/detail/{course_id}/student', [CourseController::class, 'viewStudentTab'])->middleware('auth')->name('courseDetailPage.student');

Route::get('/topic/{topic_id}/material/add', [MaterialController::class, 'viewAddMaterialPage'])->middleware('only.lecturer')->name('addMaterialPage.view');
Route::post('/topic/{topic_id}/material/add', [MaterialController::class, 'addNewMaterial'])->name('addMaterialPage.add');

Route::get('/download/material/{material_id}', [MaterialController::class, 'downloadMaterial'])->name('material.download');
Route::delete('/delete/material/{material_id}', [MaterialController::class, 'deleteMaterial'])->middleware('only.lecturer')->name('material.delete');

Route::get('/course/{course_id}/assignment/add', [CourseController::class, 'viewAddAssignmentPage'])->middleware('only.lecturer')->name('addAssignmentPage.view');
Route::post('/course/{course_id}/assignment/add', [AssignmentController::class, 'addNewAssignment'])->name('addAssignmentPage.add');

Route::get('/assignment/{assignment_id}/edit', [AssignmentController::class, 'viewEditAssignmentPage'])->middleware('only.lecturer')->name('editAssignmentPage.view');
Route::put('/assignment/{assignment_id}/edit', [AssignmentController::class, 'updateAssignment'])->name('editAssignmentPage.update');

Route::get('/assignment/detail/{assignment_id}', [AssignmentController::class, 'viewAssignmentDetailPage'])->middleware('auth')->name('assignmentDetailPage.view');

Route::get('/assignment/{assignment_id}/submit', [AssignmentController::class, 'viewSubmissionPage'])->middleware('auth')->name('submissionPage.view');
Route::post('/assignment/{assignment_id}/submit', [SubmissionController::class, 'submitAssignment'])->name('submissionPage.submit');

Route::get('submission/{submission_id}', [SubmissionController::class, 'downloadSubmission'])->name('submission.download');

Route::get('/download/assignment/{assignment_id}', [AssignmentController::class, 'downloadAssignment'])->name('assignment.download');

Route::get('/courses/enroll/{course_id}', [CourseController::class, 'viewEnrollmentPage'])->middleware('auth')->name('enrollmentPage.view');
Route::post('/courses/enroll/{course_id}', [EnrollmentController::class, 'enrollToCourse'])->middleware('auth')->name('enrollmentPage.enroll');

Route::get('/about-us', function () {return view('main.AboutUsPage');})->name('aboutUsPage.view');

Route::get('/profile', function () {return view('main.ProfilePage');})->middleware('auth')->name('profilePage.view');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profilePage.update');
Route::delete('/profile', [UserController::class, 'deletePhoto'])->name('profilePage.delete');

Route::get('/change-password', function () {return view('main.ChangePasswordPage');})->middleware('auth')->name('changePasswordPage.view');
Route::put('/change-password', [UserController::class, 'changePassword'])->name('changePasswordPage.update');