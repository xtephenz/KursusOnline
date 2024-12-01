<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function addNewAssignment($course_id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'assignment' => 'required|file|max:10000',
            'attempts' => 'nullable|integer|min:1',
            'start' => 'required|date|after_or_equal:today',
            'due' => 'required|date|after:start'
        ]);
        $assignment = $request->assignment->store('assignments', 'local');
        if($request->start > now()){
            $status = 'Coming Soon';
        }
        else{
            $status = 'On Going';
        }
        Assignment::create([
            'course_id' => $course_id,
            'title' => $request->title,
            'file_name' => $assignment,
            'attempts' => $request->attempts ? $request->attempts : null,
            'start_date' => $request->start,
            'due_date' => $request->due,
            'status' => $status
        ]);
        return redirect()->route('courseDetailPage.assignment', ['course_id' => $course_id])->with('success', 'New assignment has been added!');
    }

    public function viewAssignmentDetailPage($assignment_id)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $submission = $assignment->submissions->where('student_id', Auth::user()->id)->first();
        $file_path = Storage::disk('local')->path($assignment->file_name);
        $file_extension = File::extension($file_path);
        $display_name = $assignment->title.'.'.$file_extension;
        $submissions = $assignment->submissions;
        return view('main.AssignmentDetailPage', ['assignment' => $assignment, 'file_name' => $display_name, 'submissions' => $submissions, 'submission' => $submission]);
    }

    public function downloadAssignment($assignment_id)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $file_path = Storage::disk('local')->path($assignment->file_name);
        $file_extension = File::extension($file_path);
        $saving_name = $assignment->title.'.'.$file_extension;
        return response()->download($file_path, $saving_name);
    }

    public function viewEditAssignmentPage($assignment_id)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $file_path = Storage::disk('local')->path($assignment->file_name);
        $file_extension = File::extension($file_path);
        $display_name = $assignment->title.'.'.$file_extension;
        return view('main.EditAssignmentPage', ['assignment' => $assignment, 'file_name' => $display_name,]);
    }

    public function updateAssignment($assignment_id, Request $request)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $request->validate([
            'title' => 'required',
            'assignment' => 'nullable|file|max:10000',
            'attempts' => 'nullable|integer|min:1',
            'start' => 'required|date|after_or_equal:today',
            'due' => 'required|date|after:start'
        ]);
        if($request->start > now()){
            $status = 'Coming Soon';
        }
        else{
            $status = 'On Going';
        }
        if($request->assignment != null){
            Storage::disk('local')->delete($assignment->file_name);
            $assignment->file_name = $request->assignment->store('assignments', 'local');
        }
        $assignment->title = $request->title;
        $assignment->attempts = $request->attempts;
        $assignment->start_date = $request->start;
        $assignment->due_date = $request->due;
        $assignment->status = $status;
        $assignment->save();
        return redirect()->route('assignmentDetailPage.view', ['assignment_id' => $assignment_id])->with('success', 'Assignment has been updated!');
    }

    public function viewSubmissionPage($assignment_id)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $submission = $assignment->submissions->where('student_id', Auth::user()->id)->first();
        $file_path = Storage::disk('local')->path($assignment->file_name);
        $file_extension = File::extension($file_path);
        $display_name = $assignment->title.'.'.$file_extension;
        return view('main.SubmissionPage', ['assignment' => $assignment, 'file_name' => $display_name, 'submission' => $submission]);
    }

    public function deleteAssignment($assignment_id)
    {
        $assignment = Assignment::with('course', 'submissions')->find($assignment_id);
        $course_id = $assignment->course->id;
        DB::transaction(function () use ($assignment) {
            $assignment->submissions->each(function ($submission) {
                Storage::disk('local')->delete($submission->file_name);
                $submission->delete();
            });
            Storage::disk('local')->delete($assignment->file_name);
            $assignment->delete();
        });
        return redirect()->route('courseDetailPage.assignment', ['course_id' => $course_id])->with('success', 'Assignment has been deleted!');
    }
}
