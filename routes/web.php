<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'loginCheck']);

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'registerCheck']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/projects', ProjectsController::class)->name('projects');

Route::get('/profile', [ProfileController::class, 'get'])->name('profile');

//Route::post('/edit/{id?}', '\\' . \App\Http\Controllers\AdController::class . '@save');
