<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function viewHomePage()
    {
        if(Auth::check()){

            $role_id = Auth::user()->role_id;
            $allCourses = [];
            $enrolledCourses = [];
            $taughtCourses = [];
            
            if($role_id == 1){
                $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->get();
                $allCourses = $allCourses->sortBy('name');
            }
            else if($role_id == 2){
                // selesaikan logic buat enroll dulu, baru bisa lanjut

                // $student = Auth::user();
                // $enrollments = $student->enrollments;
                // foreach ($enrollments as $enrollment){
                //     $enrolledCourses[] = $enrollment->course;
                // }
                // dd($enrolledCourses);
                // $enrolledCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find();
                $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->orderBy('name')->paginate(6);
            }
            else if($role_id == 3){
    
            }    
            return view('main.HomePage', compact('allCourses', 'enrolledCourses', 'taughtCourses'));
        }
        else{
            $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->orderBy('name')->paginate(9);
            return view('main.HomePage', ['courses' => $allCourses]);
        }
    }

    public function viewCourseDetails($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        return view('main.CourseDetailPage', ['course' => $course]);
    }
}
