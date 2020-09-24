<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use phpDocumentor\Reflection\Types\Collection;

final class LabelsController
{
    public function __invoke()
    {
        $projects = Project::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        $labels = collect();

        foreach($projects as $project) {
            foreach ($project->labels as $label) {
                $labels->prepend($label);
            }
        }
        return view('labels', ['labels' => $labels]);
    }
}

