<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectList = Project::orderBy('finish_date', 'desc')->get();

        foreach ($projectList as $project) {
            $project = ProjectController::formatData($project);
        }
        return view('admin.projects.index', compact('projectList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $typeList = Type::all();
        return view('admin.projects.create', compact('typeList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $newProject = new Project();
        $newProject->fill($request->all());
        $newProject->image = Storage::put('img', $request->image);
        $newProject->slug = Str::slug($newProject->title);
        $newProject->save();
        return redirect()->route('admin.project.show', ['project' => $newProject->slug])->with('message', 'Progetto '.$newProject->title.' salvato corrattamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {   
        $project = ProjectController::formatData($project);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $typeList = Type::all();
        return view('admin.projects.edit', compact('project', 'typeList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        if($request->image){
            Storage::delete($project->image);
        }

        $project->fill($request->all());
        $project->slug = Str::slug($project->title);
        $project->image = Storage::put('img', $request->image);
        $project->save();
        return redirect()->route('admin.project.show', ['project' => $project->slug])->with('message', 'Progetto '.$project->title.' modificato corrattamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->image){
            Storage::delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.project.index')->with('message', 'Progetto '.$project->title.' eliminato corrattamente');
    }

    protected function formatData(Project $project) {
        if(!is_null($project->start_date)) {
            $project->start_date = date_format(new DateTime($project->start_date), 'd/m/y');
        } else {
            $project->start_date = 'N/D';
        }

        if(!is_null($project->finish_date)) {
            $project->finish_date = date_format(new DateTime($project->finish_date), 'd/m/y');
        } else {
            $project->finish_date = 'N/D';
        }

        if(!is_null($project->type_id)) {
            $project->type_id = $project->type->name;
        } else {
            $project->type_id = 'N/D';
        }

        return $project;
    }
}
