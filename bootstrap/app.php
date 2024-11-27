<?php

use App\Http\Middleware\AlreadyLoggedIn;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyLecturer;
use App\Http\Middleware\RedirectAdminFromHomePage;
use App\Http\Middleware\RestrictAdminFromHomePage;
use App\Http\Middleware\RestrictGuestFromEnrolling;
use App\Http\Middleware\RestrictGuestFromViewCourseDetails;
use App\Http\Middleware\RestrictLecturerFromCoursesPage;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'restrict.admin' => RestrictAdminFromHomePage::class,
            'restrict.enroll' => RestrictGuestFromEnrolling::class,
            'restrict.details' => RestrictGuestFromViewCourseDetails::class,
            'logged.in' => AlreadyLoggedIn::class,
            'only.admin' => OnlyAdmin::class,
            'restrict.lecturer' => RestrictLecturerFromCoursesPage::class,
            'only.lecturer' => OnlyLecturer::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();