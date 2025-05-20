<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProjectController extends Controller
{
    public function index() {
    $projects = Project::all();
    return view('projects.index', compact('projects'));
}
    public function create() {
    return view('projects.create');
}




    public function store(Request $request)
{
        $request->validate([
        'title' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);
    $imagePath = $request->file('image')->store('projects', 'public');
    $project = new Project();
    $project->title = $request->title;
    $project->description = $request->description;
    $project->project_url = $request->project_url;
    $project->image = $imagePath; 
    $project->status = 'draft'; 
    $project->save();


    return redirect()->route('projects.index');
}
public function show(Project $project) {
    return view('projects.show', compact('project'));
}
public function edit(Project $project) {
    return view('projects.edit', compact('project'));
}
public function update(Request $request, Project $project)
{
    $request->validate([
        'title' => 'required',
        'description' => 'nullable|string',
        'project_url' => 'nullable|url',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'status' => 'required|in:draft,published',
    ]);
    if ($request->hasFile('image')) {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->image = $request->file('image')->store('projects', 'public');
    }

    $project->title = $request->title;
    $project->description = $request->description;
    $project->project_url = $request->project_url;
    $project->status = $request->status;

    $project->save();

    return redirect()->route('projects.index')->with('success', 'Project updated!');
}


public function destroy(Project $project) {
    Storage::disk('public')->delete($project->image);
    $project->delete();
    return redirect()->route('projects.index')->with('success', 'Project deleted!');
}

}
