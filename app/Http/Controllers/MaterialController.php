<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MaterialController extends Controller
{
    public function viewAddMaterialPage($topic_id)
    {
        $topic = Topic::with('course', 'materials')->find($topic_id);
        return view('main.AddMaterialPage', ['topic' => $topic]);
    }

    public function addNewMaterial($topic_id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'material' => 'required|file|max:10000'
        ]);
        
        $material = $request->material->store('materials', 'public');

        Material::create([
            'topic_id' => $topic_id,
            'title' => $request->title,
            'file_name' => $material
        ]);

        $topic = Topic::with('course', 'materials')->find($topic_id);
        return redirect()->route('courseDetailPage.view', ['course_id' => $topic->course->id, 'topic_id' => $topic_id])->with('success', 'New material has been added!');
    }

    public function downloadMaterial($material_id)
    {
        $material = Material::with('topic')->find($material_id);
        $file_path = public_path('storage/'.$material->file_name);
        $file_extension = File::extension($file_path);
        $saving_name = $material->title.'.'.$file_extension;
        return response()->download($file_path, $saving_name);
    }
}
