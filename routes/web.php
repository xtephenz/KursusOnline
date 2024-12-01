<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'viewHomePage'])->middleware('restrict.admin')->name('homePage.view');

Route::get('/registration', [UserController::class, 'viewRegisterPage'])->middleware('logged.in')->name('registerPage.view');
Route::post('/register', [UserController::class, 'register'])->name('registerPage.register');

Route::get('/login', function(){return view('main.LoginPage');})->middleware('logged.in')->name('loginPage.view');
Route::post('/login', [UserController::class, 'login'])->name('loginPage.login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('loginPage.logout');

Route::get('/courses', [CourseController::class, 'viewCoursesPage'])->middleware('restrict.lecturer')->name('coursesPage.view');

Route::get('/search', [CourseController::class, 'searchCourse'])->name('search');

Route::get('/course/add', [UserController::class, 'viewAddCoursePage'])->middleware('only.admin')->name('addCoursePage.view');
Route::post('/course/add', [CourseController::class, 'addNewCourse'])->middleware('only.admin')->name('addCoursePage.add');

Route::get('/course/{course_id}/edit', [CourseController::class, 'viewEditCoursePage'])->middleware('only.admin')->name('editCoursePage.view');
Route::put('/course/{course_id}/edit', [CourseController::class, 'editCourse'])->middleware('only.admin')->name('editCoursePage.update');

Route::get('/course-detail/{course_id}/topic/{topic_id?}', [CourseController::class, 'viewCourseDetailPage'])->middleware('auth')->name('courseDetailPage.view');
Route::get('/course-detail/{course_id}/assignment', [CourseController::class, 'viewAssignmentTab'])->middleware('auth')->name('courseDetailPage.assignment');
Route::get('/course-detail/{course_id}/student', [CourseController::class, 'viewStudentTab'])->middleware('auth')->name('courseDetailPage.student');

Route::delete('/course/{course_id}/delete', [CourseController::class, 'deleteCourse'])->middleware('only.admin')->name('courseDetailPage.delete');

Route::get('/course/{course_id}/topic/add', [CourseController::class, 'viewAddTopicPage'])->middleware('only.admin')->name('addTopicPage.view');
Route::post('/course/{course_id}/topic/add', [TopicController::class, 'addNewTopics'])->middleware('only.admin')->name('addTopicPage.add');

Route::get('/topic/{topic_id}/edit', [TopicController::class, 'viewEditTopicPage'])->middleware('only.admin')->name('editTopicPage.view');
Route::put('/topic/{topic_id}/edit', [TopicController::class, 'editTopic'])->middleware('only.admin')->name('editTopicPage.update');

Route::delete('/topic/{topic_id}/delete', [TopicController::class, 'deleteTopic'])->middleware('only.admin')->name('topic.delete');

Route::get('/topic/{topic_id}/material/add', [MaterialController::class, 'viewAddMaterialPage'])->middleware('only.lecturer')->name('addMaterialPage.view');
Route::post('/topic/{topic_id}/material/add', [MaterialController::class, 'addNewMaterial'])->middleware('only.lecturer')->name('addMaterialPage.add');

Route::get('/material/{material_id}/download', [MaterialController::class, 'downloadMaterial'])->name('material.download');
Route::delete('/material/{material_id}/delete', [MaterialController::class, 'deleteMaterial'])->middleware('auth', 'restrict.student')->name('material.delete');

Route::get('/course/{course_id}/assignment/add', [CourseController::class, 'viewAddAssignmentPage'])->middleware('only.lecturer')->name('addAssignmentPage.view');
Route::post('/course/{course_id}/assignment/add', [AssignmentController::class, 'addNewAssignment'])->middleware('only.lecturer')->name('addAssignmentPage.add');

Route::get('/assignment/{assignment_id}/edit', [AssignmentController::class, 'viewEditAssignmentPage'])->middleware('only.lecturer')->name('editAssignmentPage.view');
Route::put('/assignment/{assignment_id}/edit', [AssignmentController::class, 'updateAssignment'])->middleware('only.lecturer')->name('editAssignmentPage.update');

Route::get('/assignment/{assignment_id}/detail', [AssignmentController::class, 'viewAssignmentDetailPage'])->middleware('auth')->name('assignmentDetailPage.view');

Route::get('/assignment/{assignment_id}/submit', [AssignmentController::class, 'viewSubmissionPage'])->middleware('only.student')->name('submissionPage.view');
Route::post('/assignment/{assignment_id}/submit', [SubmissionController::class, 'submitAssignment'])->middleware('only.student')->name('submissionPage.submit');

Route::get('/assignment/{assignment_id}/download', [AssignmentController::class, 'downloadAssignment'])->middleware('auth')->name('assignment.download');
Route::delete('/assignment/{assignment_id}/delete', [AssignmentController::class, 'deleteAssignment'])->middleware('only.lecturer')->name('assignment.delete');

Route::get('/submission/{submission_id}/download', [SubmissionController::class, 'downloadSubmission'])->middleware('only.lecturer')->name('submission.download');

Route::get('/submission/{submission_id}/scoring', [SubmissionController::class, 'viewScoringPage'])->middleware('only.lecturer')->name('scoringPage.view');
Route::put('/submission/{submission_id}/scoring', [SubmissionController::class, 'scoreSubmission'])->middleware('only.lecturer')->name('scoringPage.score');

Route::get('/course/{course_id}/enroll', [CourseController::class, 'viewEnrollmentPage'])->middleware('auth')->name('enrollmentPage.view');
Route::post('/course/{course_id}/enroll', [EnrollmentController::class, 'enrollToCourse'])->middleware('auth')->name('enrollmentPage.enroll');

Route::get('/course/{course_id}/enrollment/{student_id}/scoring', [EnrollmentController::class, 'viewFinalScoreSubmissionPage'])->middleware('only.lecturer')->name('finalScoreSubmissionPage.view');
Route::put('/course/{course_id}/enrollment/{student_id}/scoring', [EnrollmentController::class, 'submitFinalScore'])->middleware('only.lecturer')->name('finalScoreSubmissionPage.submit');

Route::get('/course/{course_id}/view-final-score', [EnrollmentController::class, 'viewFinalScorePage'])->middleware('only.student')->name('finalScorePage.view');

Route::get('/about-us', function () {return view('main.AboutUsPage');})->name('aboutUsPage.view');

Route::get('/profile', function () {return view('main.ProfilePage');})->middleware('auth')->name('profilePage.view');
Route::put('/profile', [UserController::class, 'updateProfile'])->middleware('auth')->name('profilePage.update');
Route::delete('/profile', [UserController::class, 'deletePhoto'])->middleware('auth')->name('profilePage.delete');

Route::get('/change-password', function () {return view('main.ChangePasswordPage');})->middleware('auth')->name('changePasswordPage.view');
Route::put('/change-password', [UserController::class, 'changePassword'])->middleware('auth')->name('changePasswordPage.update');