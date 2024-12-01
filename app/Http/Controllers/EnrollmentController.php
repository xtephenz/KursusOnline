<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
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

    public function viewFinalScoreSubmissionPage($course_id, $student_id)
    {
        $enrollment = Enrollment::with('student', 'course')->where('student_id', $student_id)->where('course_id', $course_id)->first();
        $course = $enrollment->course;
        $assignments = $course->assignments;
        $submissions = collect();
        foreach ($assignments as $assignment) {
            $studentSubmissions = $assignment->submissions->where('student_id', $student_id);
            $submissions = $submissions->merge($studentSubmissions);
        }
        $scores = collect($submissions)->pluck('score')->filter();
        $final_score = number_format($scores->sum() / count($assignments), 2);
        return view('main.FinalScoreSubmissionPage', ['enrollment' => $enrollment, 'submissions' => $submissions, 'score' => $final_score]);
    }

    public function submitFinalScore($course_id, $student_id, Request $request)
    {
        $enrollment = Enrollment::with('student', 'course')->where('student_id', $student_id)->where('course_id', $course_id)->first();
        $request->validate([
            'score' => 'required|numeric|min:0|max:100'
        ]);
        $enrollment->final_score = $request->score;
        $enrollment->status = 'Finished';
        $enrollment->save();
        return redirect()->route('courseDetailPage.student', ['course_id' => $course_id]);
    }

    public function viewFinalScorePage($course_id)
    {
        $student_id = Auth::user()->id;
        $enrollment = Enrollment::with('student', 'course')->where('student_id', $student_id)->where('course_id', $course_id)->first();
        $course = $enrollment->course;
        $assignments = $course->assignments;
        $submissions = collect();
        foreach ($assignments as $assignment) {
            $studentSubmissions = $assignment->submissions->where('student_id', $student_id);
            $submissions = $submissions->merge($studentSubmissions);
        }
        return view('main.FinalScorePage', ['enrollment' => $enrollment, 'submissions' => $submissions]);
    }
}
