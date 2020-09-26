@extends('layout')

@section('title', 'My projects')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">My projects</a>
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


    @if(Session::has('successful project delete'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful project delete') }}
        </div>
    @endif
    @if(Session::has('successful project create'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful project create') }}
        </div>
    @endif
    @if(Session::has('successful project link to user'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful project link to user') }}
        </div>
    @endif
    @if(Session::has('successful label link to project'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful label link to project') }}
        </div>
    @endif


    @auth
    <a href="{{ route('project.create') }}" class="btn btn-success btn-lg">Create a new project</a>
    <a href="{{ route('user.link') }}" class="btn btn-warning btn-lg">Link project to user</a>
    <a href="{{ route('label.link') }}" class="btn btn-info btn-lg">Link label to project</a>
    <br>
    <br>
    @endauth

    @forelse($projects as $project)
        <div class="card text-center" style="margin-bottom: 20px">
            <div class="card-header">
                <h3><span class="badge badge-secondary">{{ auth()->user()->projects->find($project->id)->pivot->is_creator ? 'You are creator of this project' : 'You are linked to this project'}}</span></h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ \Illuminate\Support\Str::limit($project->name, 50) }}</h5>
                @foreach($project->labels as $label)
                    <p class="card-text">{{ $label->name }}
                @can('delete', $label)
                        <a href="{{ route('label.delete', ['id' => $label->id]) }}" class="badge badge-danger">Delete</a></p>
                @endcan
                @endforeach
            </div>
            <div class="card-footer text-muted">
                @can('delete', $project)
                    <a href="{{ route('project.delete', ['id' => $project->id]) }}" class="btn btn-danger">Delete</a>
                @endcan
                @cannot('delete', $project)
                        {{ 'Created by ' . $project->users->first()->name }}
                @endcannot
            </div>
        </div>
        <br>
        <br>


    @empty
        <div class="alert alert-info" role="alert">
            <p>You have not created any projects.</p>
            <p>You have not got any linked projects.</p>
            <p>Start creating projects now!</p>
        </div>
    @endforelse

@endsection
