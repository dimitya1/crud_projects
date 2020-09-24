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

    @forelse($projects as $project)
        <div class="card text-center" style="margin-bottom: 20px">
            <div class="card-header">
{{--                @if($project->users->first()-> == auth()->id())--}}
{{--                    Yes--}}
{{--                    @else No--}}
{{--                    @endif--}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ \Illuminate\Support\Str::limit($project->name, 50) }}</h5>
                @foreach($project->labels as $label)
                    <p class="card-text">{{ $label->name }}
                        <a href="{{ route('label.delete', ['id' => $label->id]) }}" class="badge badge-danger">Delete</a></p>
                @endforeach
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
        <div class="alert alert-info" role="alert">
            <p>You have not created any projects.</p>
            <p>You have not got any linked projects.</p>
            <p>Start creating projects now!</p>
        </div>
    @endforelse

@endsection
