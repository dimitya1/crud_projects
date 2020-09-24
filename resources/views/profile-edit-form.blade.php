@extends('layout')

@section('title', 'Profile edit form')

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
                <a class="dropdown-item active" href="{{ route('register') }}">Register</a>
             </div>
             @endguest
        </li>
    </ul>
    <br>


    @if(Session::has('password does not match'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('password does not match') }}
        </div>
    @endif


    <form method="post" action="{{ route('profile.edit') }}">
        @csrf

        <div class="form-group">
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="name">Full name</label>
            <input type="name" name="name" class="form-control"
                   value="{{ old('title', $authUser->name) }}">
            <small id="nameHelp" class="form-text text-muted">We'll never share your personal data with anyone else.</small>
        </div>

        <fieldset disabled>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ old('email', $authUser->email) }}">
            </div>
        </fieldset>

        <div class="form-group">
            @error('country')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="country">Country</label>
            <input type="country" name="country" class="form-control"
            value="{{ old('title', $authUser->country->name) }}">
        </div>

        <div class="form-group">
            @error('password')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="password">Please, enter your password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
@endsection
