@extends('layout')

@section('title', 'My labels')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects') }}">My projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">My labels</a>
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


    @if(Session::has('successful label delete'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful label delete') }}
        </div>
    @endif
    @if(Session::has('successful label create'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful label create') }}
        </div>
    @endif
    @error('not allowed')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror


    @auth
    <a href="{{ route('label.create') }}" class="btn btn-success btn-lg">Create a new label</a>
    <a href="{{ route('label.link') }}" class="btn btn-info btn-lg">Link label to project</a>
    <br>
    <br>
    @endauth


    <ul class="list-group list-group-flush">

    @forelse($labels as $label)
        <li class="list-group-item">{{ $label->name }}</li>

        @cannot('delete', $label)
        <div class="d-flex w-100 justify-content-between">
            <small class="text-muted">{{ 'Created by ' . \App\Models\User::find($label->user_id)->name}}</small>
        </div>
        @endcannot

        <p class="text-left">
            @can('delete', $label)
                <a href="{{ route('label.delete', ['id' => $label->id]) }}" class="btn btn-danger">Delete</a>
            @endcan
        </p>
        <br>
        <br>
    @empty
        <div class="alert alert-info" role="alert">
            <p>You have not created any labels.</p>
            <p>You have not got any linked labels.</p>
            <p>Start creating labels now!</p>
        </div>
    @endforelse
    </ul>

@endsection
