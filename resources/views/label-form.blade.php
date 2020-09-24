@extends('layout')

@section('title', 'Label form')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects') }}">My projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('labels') }}">My labels</a>
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


    <form method="post" action="{{ route('label.create') }}">
        @csrf

        <div class="form-group">
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
