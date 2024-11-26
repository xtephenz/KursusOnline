<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function viewHomePage()
    {
        $allCourses = collect();
        $enrolledCourses = collect();
        $taughtCourses = collect();
        // kalau user sudah login
        if(Auth::check()){
            $role_id = Auth::user()->role_id;
            // tampilkan sesuai role masing-masing
            if($role_id == 2){
                $student = Auth::user();
                $enrollments = $student->enrollments;
                foreach ($enrollments as $enrollment){
                    $enrolledCourses->push($enrollment->course);
                }

                $student_id = $student->id;
                $enrolledCourseIds = $enrollments->filter(function($enrollment) use ($student_id) {
                    return $enrollment->student_id == $student_id;
                })->pluck('course_id');
                $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->whereNotIn('id', $enrolledCourseIds)->orderBy('name')->paginate(9);
            }
            else if($role_id == 3){
                $lecturer = Auth::user();
                $taughtCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->where('lecturer_id', $lecturer->id)->get();
            }    
        }
        // kalau tidak login, tampilannya hanya bisa lihat semua course
        else{
            $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->orderBy('name')->paginate(9);
        }
        return view('main.HomePage', compact('allCourses', 'enrolledCourses', 'taughtCourses'));
    }

    public function viewEnrollmentPage($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        return view('main.EnrollmentPage', ['course' => $course]);
    }

    public function enrollToCourse($course_id)
    {
        $student_id = Auth::user()->id;
        $enrollment = Enrollment::with('student', 'course')->where('student_id', $student_id)->where('course_id', $course_id)->first();
        if($enrollment){
            if($enrollment->status == 'Cancelled'){
                $enrollment->update([
                    'status' => 'Active',
                    'enroll_date' => now()->toDateString()
                ]);
                return redirect()->route('homePage.view');
            }
        }
        Enrollment::create([
            'student_id' => $student_id,
            'course_id' => $course_id,
            'enroll_date' => now()->toDateString(),
        ]);
        return redirect()->route('homePage.view');
    }

    public function viewCoursesPage()
    {
        $allCourses = collect();
        if(Auth::check()){
            $role_id = Auth::user()->role_id;
            
            if($role_id == 1){
                $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->orderBy('name')->paginate(9);
            }
            else if($role_id == 2){
                $student = Auth::user();
                $enrollments = $student->enrollments;
                $student_id = $student->id;
                $enrolledCourseIds = $enrollments->filter(function($enrollment) use ($student_id) {
                    return $enrollment->student_id == $student_id;
                })->pluck('course_id');
                $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->whereNotIn('id', $enrolledCourseIds)->orderBy('name')->paginate(9);
            }
        }
        else{
            $allCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->orderBy('name')->paginate(9);
        }
        return view('main.CoursesPage', ['allCourses' => $allCourses]);
    }

    public function viewCourseDetailPage($course_id, $topic_id = 0)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        if($topic_id == 0) $topic = $course->topics->first();
        else $topic = Topic::with('course', 'materials')->find($topic_id);
        return view('main.CourseDetailPage', ['course' => $course, 'topic' => $topic]);
    }

    public function viewAssignmentTab($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        $assignments = $course->assignments;
        return view('main.CourseDetailPage', ['course' => $course, 'assignments' => $assignments]);
    }

    public function viewStudentTab($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        $enrollments = $course->enrollments()->where('status', 'Active')->get();
        $enrolledStudents = collect();
        foreach ($enrollments as $enrollment) {
            $enrolledStudents->push($enrollment->student);
        }
        return view('main.CourseDetailPage', ['course' => $course, 'students' => $enrolledStudents]);
    }
}
