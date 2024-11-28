<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function submitAssignment($assignment_id, Request $request)
    {
        $student_id = Auth::user()->id;
        $request->validate([
            'submission' => 'required|file|max:10000'
        ]);
        $submission_file = $request->submission->store('submissions', 'local');

        Submission::create([
            'assignment_id' => $assignment_id,
            'student_id' => $student_id,
            'file_name' => $submission_file,
            'submit_date' => now(),
        ]);
        return redirect()->route('assignmentDetailPage.view', ['assignment_id' => $assignment_id]);
    }

    public function downloadSubmission($submission_id)
    {
        $submission = Submission::with('student', 'assignment')->find($submission_id);
        $file_path = Storage::disk('local')->path($submission->file_name);
        $file_extension = File::extension($file_path);
        $saving_name = $submission->assignment->title.'_'.$submission->student->name.'_Answer'.'.'.$file_extension;
        return response()->download($file_path, $saving_name);
    }
}
