<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('id', 'label')->get();
        $technologies = Technology::select('id', 'label')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $project = new Project();
        if (array_key_exists('image', $data)) {
            $img_url = Storage::putFile('project_images', $data['image']);
            $data['image'] = $img_url;
        };
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'link' => 'required|url:http,https',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ]);
        $project->fill($data);
        $project->save();
        if (Arr::exists($data, 'technologies')) $project->technologies()->attach($data['technologies']);
        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::findOrFail($id);
        return view('admin.projects.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('id', 'label')->get();
        $technologies = Technology::select('id', 'label')->get();
        $project_technology_ids = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'project_technology_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $request->validate([
            'title' => ['required', 'string'],
            'description' => 'required|string',
            'link' => 'required|url:http,https',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ]);

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_images', $data['image']);
            $data['image'] = $img_url;
        };

        $project->update($data);

        if (!Arr::exists($data, 'technologies') && count($project->technologies)) $project->technologies()->detach();
        elseif (Arr::exists($data, 'technologies')) $project->technologies()->sync($data['technologies']);

        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }
}
