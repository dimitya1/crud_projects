@extends('layout')

@section('title', 'Register form')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects') }}">My projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">My labels</a>
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
            <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Your profile</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="#">Register</a>
             </div>
             @endguest
        </li>
    </ul>
    <br>

    @if(Session::has('duplicate email'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('duplicate email') }}
        </div>
    @endif

    <form method="post" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="name">Full name</label>
            <input type="name" name="name" class="form-control">
            <small id="nameHelp" class="form-text text-muted">We'll never share your personal data with anyone else.</small>
        </div>

        <div class="form-group">
            @error('email')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            @error('country')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="country">Country</label>
            <input type="country" name="country" class="form-control">
        </div>

        <div class="form-group">
            @error('password')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            <small id="passwordHelp" class="form-text text-muted">Your password must contain of uppercase and lowercase letters, at least 6 characters and at least one digit.</small>
        </div>

        <div class="form-group">
            @error('password_confirm')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="password_confirm">Confirm password</label>
            <input type="password" name="password_confirm" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
