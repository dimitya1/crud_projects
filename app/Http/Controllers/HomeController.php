<?php

namespace App\Http\Controllers;

final class HomeController
{
    public function __invoke()
    {
        return view('home');
    }
}

