<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

final class ProjectsController
{
    public function get()
    {
        $projects = Project::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        return view('projects', ['projects' => $projects]);
    }

    public function delete($id = null)
    {
        $project = Project::find($id);

        $project->delete();

        return back()
            ->with('successful project delete', "Project \"{$project->name}\" was successfully deleted!");
    }

    public function create()
    {
        return view('project-form');
    }

    public function save()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:10|max:255',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('project.create')
                ->withErrors($validator->errors());
        }

        $project = new Project();
        $project->name = request()->get('name');
        $project->save();
        $project->users()->attach(auth()->id(), ['is_creator' => 1]);

        return redirect()
            ->route('projects')
            ->with('successful project create', "Project \"{$project->name}\" was successfully created!");
    }
}

