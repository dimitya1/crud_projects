<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

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
}

