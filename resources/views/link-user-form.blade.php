@extends('layout')

@section('title', 'Link user form')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('projects') }}">My projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('labels') }}">My labels</a>
        </li>
        <li class="nav-item dropdown">
            @auth
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile') }}">My profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
            @endauth
            @guest
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Your profile</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Register</a>
             </div>
             @endguest
        </li>
    </ul>
    <br>


    @if(Session::has('no such email'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('no such email') }}
        </div>
    @endif
    @if(Session::has('own email'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('own email') }}
        </div>
    @endif


    <form method="post" action="{{ route('user.link') }}">
        @csrf
        <div class="form-group">
            @error('project')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="project">Project</label>
            <select id="project" name="project" class="form-control">
                <option selected></option>
                @foreach($projects as $project)
                    <option>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            @error('user')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="user">User email</label>
            <input type="email" name="user" class="form-control">
            <small id="emailHelp" class="form-text text-muted">User will be linked to your project if email is correct.</small>
        </div>

        <button type="submit" class="btn btn-primary">Link user</button>
    </form>
@endsection
