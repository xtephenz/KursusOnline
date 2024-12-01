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
        $submission = Submission::with('student', 'assignment')->where('assignment_id', $assignment_id)->where('student_id', $student_id)->first();
        if($submission != null){
            Storage::disk('local')->delete($submission->file_name);
            $submission->file_name = $submission_file;
            $submission->attempt_number += 1;
            $submission->submit_date = now();
            if($submission->score != null){
                $submission->status = 'Waiting To Be Assessed';
                $submission->score = null;
            }
            $submission->save();
        }
        else{
            Submission::create([
                'assignment_id' => $assignment_id,
                'student_id' => $student_id,
                'file_name' => $submission_file,
                'submit_date' => now(),
            ]);
        }
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

    public function viewScoringPage($submission_id)
    {
        $submission = Submission::with('student', 'assignment')->find($submission_id);
        $file_path = Storage::disk('local')->path($submission->file_name);
        $file_name = basename($file_path);
        return view('main.ScoringPage', ['submission' => $submission, 'file_name' => $file_name]);
    }

    public function scoreSubmission($submission_id, Request $request)
    {
        $submission = Submission::with('student', 'assignment')->find($submission_id);
        $request->validate([
            'score' => 'required|integer|min:0'
        ]);
        $submission->score = $request->score;
        $submission->status = 'Assessed';
        $submission->save();
        return redirect()->route('assignmentDetailPage.view', ['assignment_id' => $submission->assignment->id]);
    }
}
