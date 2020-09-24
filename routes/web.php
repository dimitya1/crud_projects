<?php

use App\Http\Controllers\LabelsController;
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

Route::get('/projects', [ProjectsController::class, 'get'])->name('projects');

Route::get('/labels', [LabelsController::class, 'get'])->name('labels');

Route::get('/profile', [ProfileController::class, 'get'])->name('profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::post('/profile/edit', [ProfileController::class, 'editCheck']);

Route::get('/delete_project/{id}', [ProjectsController::class, 'delete'])->name('project.delete');

Route::get('/create_project', [ProjectsController::class, 'create'])->name('project.create');

Route::post('/create_project', [ProjectsController::class, 'save']);

Route::get('/delete_label/{id}', [LabelsController::class, 'delete'])->name('label.delete');

Route::get('/create_label', [LabelsController::class, 'create'])->name('label.create');

Route::post('/create_label', [LabelsController::class, 'save']);
//Route::post('/edit/{id?}', '\\' . \App\Http\Controllers\AdController::class . '@save');
