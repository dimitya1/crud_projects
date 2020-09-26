@extends('layout')

@section('title', 'Your profile')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects') }}">My projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('labels') }}">My labels</a>
        </li>
        <li class="nav-item dropdown">
            @auth
            <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active" href="#">My profile</a>
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


    @if(Session::has('nothing to update'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('nothing to update') }}
        </div>
    @endif
    @if(Session::has('success profile edit'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('success profile edit') }}
        </div>
    @endif


    <div class="card bg-light mb-3" style="max-width: 40rem;">
        <div class="card-header">{{ $authUser->email }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ $authUser->name }}</h5>
            <h5 class="card-title">{{ $authUser->country->name }}</h5>
            <p class="card-text">You have {{ $authUser->projects->count() }} projects.</p>
            <p class="card-text">You have {{ $labelsCount }} labels.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">You created your profile {{ $authUser->created_at->diffForHumans() }}</small>
        </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-lg">Edit</a>
@endsection
