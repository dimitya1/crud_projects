@extends('layout')

@section('title', 'Home page')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link active" href="#">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects') }}">My projects</a>
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
                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
             </div>
             @endguest
        </li>
    </ul>
    <br>



    @if(Session::has('successful login'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful login') }}
        </div>
    @endif
    @if(Session::has('successful register'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful register') }}
        </div>
    @endif
    @if(Session::has('successful project delete'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful project delete') }}
        </div>
    @endif


    @forelse($projects as $project)
        <div class="card text-center" style="margin-bottom: 20px">
            <div class="card-header">
{{--                @if($project->users->first()-> == auth()->id())--}}
{{--                    Yes--}}
{{--                    @else No--}}
{{--                    @endif--}}
            </div>
            <div class="card-body">
                <p class="card-text">{{ \Illuminate\Support\Str::limit($project->name, 50) }}</p>
            </div>
            <div class="card-footer text-muted">
                {{ 'Created ' . $project->created_at->diffForHumans() }} by {{ $project->users->first()->name }}
            </div>
        </div>
        <p class="text-center">
            @can('delete', $project)
                <a href="{{ route('project.delete', ['id' => $project->id]) }}" class="btn btn-danger">Delete</a>
            @endcan
        </p>
        <br>
        <br>


    @empty
        <h2><p class="text-center">This website allows you to keep your projects and label together.</p></h2>
        <br>
        <h2><p class="text-center">Nobody will seed your projects or labels until you link them to user.</p></h2>
        <br>
        @guest
        <h2><p class="text-center">Please, register or log in to start using our website.</p></h2>
        <br>
        @endguest
        <h2><p class="text-center">Start creating projects with our website now!</p></h2>
        <br>
    @endforelse

@endsection
