<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

final class AuthController
{
    public function login()
    {
        return view('login-form');
    }

    public function loginCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'email' => 'email|required|min:10|max:40',
                'password' => 'required|min:6|max:70|regex:/[a-z]/',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors());
        }

        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email or password' => 'Invalid email or password!']);
        }

        return redirect()
            ->route('home')
            ->with('successful login', 'You have logged in successfully. Here are your projects.');
    }




    public function logout()
    {
        Auth::logout();
        return back();
    }


    public function register()
    {
        return view('register-form');
    }


    public function registerCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
                'email' => 'required|min:9|max:45|email',
                'country' => 'required|min:3|max:25',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
                'password_confirm' => 'required|same:password',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator->errors());
        }

        $userDataArray = request()->all();

        if (User::where('email', $userDataArray['email'])->first() == null) {
            $user = new User();
            $user->name = $userDataArray['name'];
            $user->email = $userDataArray['email'];
            $user->password = bcrypt($userDataArray['password']);

            if (Country::where('name', $userDataArray['country'])->first() == null) {
                $country = new Country();
                $country->name = $userDataArray['country'];
                $country->continent_id = rand(1, 7);
                $country->save();
                $user->country_id = $country->id;
            } else $user->country_id = Country::where('name', $userDataArray['country'])->first()->id;

            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();

            Auth::login($user);

            return redirect()
                ->route('home')
                ->with('successful register', 'You have registered successfully. Lets create a new project!');

        } else return redirect()
            ->route('register')
            ->with('duplicate email', 'User with email' . $userDataArray['email'] . ' is already registered!');
    }
}

