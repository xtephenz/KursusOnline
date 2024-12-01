<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function viewHomePage()
    {
        $allCourses = collect();
        $activeCourses = collect();
        $finishedCourses = collect();
        $taughtCourses = collect();
        // kalau user sudah login
        if(Auth::check()){
            $role_id = Auth::user()->role_id;
            // tampilkan sesuai role masing-masing
            if($role_id == 2){
                $student = Auth::user();
                $activeEnrollments = $student->enrollments->where('status', 'Active');
                foreach ($activeEnrollments as $enrollment){
                    $activeCourses->push($enrollment->course);
                }
                $finishedEnrollments = $student->enrollments->where('status', 'Finished');
                foreach ($finishedEnrollments as $enrollment){
                    $finishedCourses->push($enrollment->course);
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
        return view('main.HomePage', compact('allCourses', 'activeCourses', 'finishedCourses', 'taughtCourses'));
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
            if($assignment->status === 'Coming Soon' && $assignment->start_date <= now()){
                $assignment->status = 'On Going';
                $assignment->save();
            }
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
        $activeEnrollments = $course->enrollments()->where('status', 'Active')->get();
        $activeStudents = collect();
        foreach ($activeEnrollments as $enrollment) {
            $activeStudents->push($enrollment->student);
        }
        $finishedEnrollments = $course->enrollments()->where('status', 'Finished')->get();
        $finishedStudents = collect();
        foreach ($finishedEnrollments as $enrollment) {
            $finishedStudents->push($enrollment->student);
        }
        return view('main.CourseDetailPage', ['course' => $course, 'activeStudents' => $activeStudents, 'finishedStudents' => $finishedStudents]);
    }

    public function addNewCourse(Request $request)
    {
        // kalau button Add Topic diklik, maka tambahkan field topic baru
        if ($request->has('add_topic')) {
            $topics = $request->input('topics', []);
            $topics[] = '';
            return redirect()->back()->withInput(['topics' => $topics]);
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

    public function viewAddTopicPage($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        return view('main.AddTopicPage', ['course' => $course]);
    }

    public function searchCourse(Request $request)
    {
        $searchQuery = $request->input('query');
        if (empty($searchQuery) && !$request->has('page')) {
            return redirect()->back()->with('empty_query', true);
        }
        $results = Course::with('lecturer', 'enrollments', 'topics', 'assignments')
        ->where(function ($query) use ($searchQuery) {
            // search berdasarkan nama course
            $query->where('name', 'LIKE', '%' . $searchQuery . '%')
            // search berdasarkan nama dosen
            ->orWhereHas('lecturer', function ($q) use ($searchQuery) {$q->where('name', 'LIKE', '%' . $searchQuery . '%');})
            // search berdasarkan nama topic
            ->orWhereHas('topics', function ($q) use ($searchQuery) {$q->where('title', 'LIKE', '%' . $searchQuery . '%');});
        })
        ->orderBy('name')
        ->paginate(9);      
        return view('main.SearchResultPage', ['allCourses' => $results, 'query' => $searchQuery]);
    }

    public function viewEditCoursePage($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        $lecturers = User::with('role', 'enrollments', 'courses', 'submissions')->where('role_id', '3')->get();
        return view('main.EditCoursePage', ['course' => $course, 'lecturers' => $lecturers]);
    }

    public function editCourse($course_id, Request $request)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        $request->validate([
            'name' => 'required|unique:courses,name,'.$course->id.'|max:100',
            'lecturer' => 'required|exists:users,id',
        ]);
        $course->name = $request->name;
        $course->lecturer_id = $request->lecturer;
        $course->save();
        return redirect()->route('courseDetailPage.view', ['course_id' => $course_id])->with('success-update', 'Course has been updated!');
    }

    public function deleteCourse($course_id)
    {
        $course = Course::with('lecturer', 'enrollments', 'topics', 'assignments')->find($course_id);
        DB::transaction(function () use ($course) {
            $course->topics->each(function ($topic) {
                $topic->materials->each(function ($material) {
                    Storage::disk('local')->delete($material->file_name);
                    $material->delete();
                });
                $topic->delete();
            });
            $course->enrollments->each->delete();
            $course->assignments->each(function ($assignment) {
                $assignment->submissions->each(function ($submission) {
                    Storage::disk('local')->delete($submission->file_name);
                    $submission->delete();
                });
                Storage::disk('local')->delete($assignment->file_name);
                $assignment->delete();
            });
            $course->delete();
        });
        return redirect()->route('coursesPage.view')->with('success', 'Course has been deleted!');
    }
}
