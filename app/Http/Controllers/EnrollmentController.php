<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
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
}
