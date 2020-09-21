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
            <a class="nav-link" href="#">My labels</a>
        </li>
        <li class="nav-item dropdown">
            @auth
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">My profile</a>
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
            @can('update', $project)
            {{--                <a href="{{ route('ad.create', ['id' => $ad->id]) }}" class="btn btn-warning">Edit</a>--}}
                <a href="#" class="btn btn-warning">Edit</a>
            @endcan
            @can('delete', $project)
                <a href="#" class="btn btn-danger">Delete</a>
            {{--                <a href="{{ route('ad.delete', ['id' => $ad->id]) }}" class="btn btn-danger">Delete</a>--}}
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
