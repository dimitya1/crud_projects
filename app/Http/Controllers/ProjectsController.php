<?php

namespace App\Http\Controllers;

use App\Models\Label;
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

    public function linkUser()
    {
        $projects = Project::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        return view('link-user-form', ['projects' => $projects]);
    }

    public function linkUserCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'user' => 'required',
                'project' => 'required|min:10',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('user.link')
                ->withErrors($validator->errors());
        }

        $userToLink = User::where('email', request()->get('user'))->first();
        if ($userToLink === null) {
            return redirect()
                ->route('user.link')
                ->with('no such email', "User with requested email is not found!");
        }
        if ($userToLink->email === auth()->user()->email) {
            return redirect()
                ->route('user.link')
                ->with('own email', "¯\_(ツ)_/¯ You cannot link a project to yourself!");
        }

        $projectToLink = Project::where('name', request()->get('project'))->first();

        $projectToLink->users()->attach($userToLink->id, ['is_creator' => 0]);

        return redirect()
            ->route('projects')
            ->with('successful project link to user', "You have successfully linked your project to user " . $userToLink->name . '!');
    }

    public function linkLabel()
    {
        $projects = Project::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        $labels = Label::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        return view('link-label-form', ['projects' => $projects, 'labels' => $labels]);
    }

    public function linkLabelCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'project' => 'required|min:10',
                'label' => 'required|min:3',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('label.link')
                ->withErrors($validator->errors());
        }

        $labelToLink = Label::where('name', request()->get('label'))->first();

        $projectToLink = Project::where('name', request()->get('project'))->first();

        $projectToLink->labels()->attach($labelToLink->id);

        return redirect()
            ->route('projects')
            ->with('successful label link to project', "You have successfully linked your label to project!");
    }
}

