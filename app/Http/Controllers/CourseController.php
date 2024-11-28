<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
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
            }
            else if($role_id == 3){
                $lecturer = Auth::user();
                $taughtCourses = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->where('lecturer_id', $lecturer->id)->orderBy('name')->paginate(9);
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
        if($topic_id == 0){
            if($course->topics != null) $topic = $course->topics->first();
            else $topic = null;
        }
        else $topic = Topic::with('course', 'materials')->find($topic_id);
        return view('main.CourseDetailPage', ['course' => $course, 'topic' => $topic]);
    }

    public function viewAssignmentTab($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        $assignments = $course->assignments()->orderBy('start_date')->orderBy('due_date')->get();
        // cek apakah due_date sudah lewat, kalau udah, langsung ganti status jadi Expired
        foreach ($assignments as $assignment) {
            if ($assignment->status === 'On Going' && $assignment->due_date < now()) {
                $assignment->status = 'Expired';
                $assignment->save();
            }
        }
        
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

    public function addNewCourse(Request $request)
    {
        // kalau button Add Topic diklik, maka tambahkan field topic baru
        if ($request->has('add_topic')) {
            $topics = $request->input('topics', []);
            $topics[] = '';
            return redirect()->back()->withInput(['topics' => $topics, 'name' => $request->name, 'lecturer' => $request->lecturer]);
        }
        $validated = $request->validate(
            [
                'name' => 'required|unique:courses,name|max:100',
                'lecturer' => 'required|exists:users,id',
                'topics' => 'required|array|min:1', // array setidaknya punya 1 elemen
                'topics.*' => 'required|string|max:255' // isi array wajib ada
            ],
            [
                'name.unique' => 'The course has already exist.',
                'topics.*.required' => 'Topic cannot be empty'
            ]
        );
        $course = Course::create([
            'name' => $request->name,
            'lecturer_id' => $request->lecturer
        ]);
        foreach ($validated['topics'] as $topic) {
            Topic::create([
                'course_id' => $course->id,
                'title' => $topic
            ]);
        }
        return redirect()->route('coursesPage.view')->with('success', 'New course has been added!');
    }

    public function viewAddAssignmentPage($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        return view('main.AddAssignmentPage', ['course' => $course]);
    }
}
