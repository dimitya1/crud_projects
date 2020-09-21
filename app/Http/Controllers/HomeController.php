<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

final class HomeController
{
    public function __invoke()
    {
        $projects = Project::whereHas('users', function($q) {
            $q->where('user_id', '=', auth()->id());
        })->orderBy('created_at', 'desc')->get();

        return view('home', ['projects' => $projects]);
    }
}

