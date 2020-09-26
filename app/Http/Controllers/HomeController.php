<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

final class HomeController
{
    public function __invoke()
    {
        return view('home');
    }
}

