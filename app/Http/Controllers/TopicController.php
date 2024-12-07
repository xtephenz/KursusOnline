<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    public function addNewTopics($course_id, Request $request)
    {
        // kalau button Add Topic diklik, maka tambahkan field topic baru
        if ($request->has('add_topic')) {
            $topics = $request->input('topics', []);
            $topics[] = '';
            return redirect()->back()->withInput(['topics' => $topics, 'name' => $request->name, 'lecturer' => $request->lecturer]);
        }
        $validated = $request->validate(
            [
                'topics' => 'required|array|min:1', // array setidaknya punya 1 elemen
                'topics.*' => 'required|string|max:255' // isi array wajib ada
            ],
            [
                'topics.*.required' => 'Topic cannot be empty'
                ]
            );
        foreach ($validated['topics'] as $topic) {
            Topic::create([
                'course_id' => $course_id,
                'title' => $topic
            ]);
        }
        if(count($validated['topics']) > 1){
            return redirect()->route('courseDetailPage.view', ['course_id' => $course_id])->with('success', 'New topics has been added!');
        }
        else return redirect()->route('courseDetailPage.view', ['course_id' => $course_id])->with('success', 'New topic has been added!');
    }

    public function viewEditTopicPage($topic_id)
    {
        $topic = Topic::with('course', 'materials')->find($topic_id);
        return view('main.EditTopicPage', ['topic' => $topic]);
    }

    public function editTopic($topic_id, Request $request)
    {
        $topic = Topic::with('course', 'materials')->find($topic_id);
        $request->validate([
            'topic' => 'required|string|max:255'
        ]);
        $topic->title = $request->topic;
        $topic->save();
        return redirect()->route('courseDetailPage.view', ['course_id' => $topic->course->id, 'topic_id' => $topic_id])->with('success', 'Topic has been updated!');
    }

    public function deleteTopic($topic_id)
    {
        $topic = Topic::with('course', 'materials')->find($topic_id);
        if($topic->materials != null){
            foreach ($topic->materials as $material) {
                Storage::disk('s3')->delete($material->file_name);
            }
        }
        $topic->delete();
        return redirect()->route('courseDetailPage.view', ['course_id' => $topic->course->id]);
    }
}
