<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        
        $material = $request->material->store('materials');

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
        $file_path = $material->file_name;
        $file_extension = File::extension($file_path);
        $saving_name = $material->title.'.'.$file_extension;
        $to_download = Storage::disk('s3')->get($file_path);
        return response($to_download)->header('Content-Disposition', 'attachment; filename="' . $saving_name . '"');
    }

    public function deleteMaterial($material_id)
    {
        $material = Material::with('topic')->find($material_id);
        Storage::disk('s3')->delete($material->file_name);
        $material->delete();
        return redirect()->back();
    }
}
