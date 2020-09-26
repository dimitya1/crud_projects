<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class ProfileController
{
    public function get() {
        $authUser = User::find(auth()->id());

        $labelsCount = 0;

        foreach($authUser->projects->all() as $project) {
            $labelsCount += $project->labels->count();
        }

        return view('profile', ['authUser' => $authUser, 'labelsCount' => $labelsCount]);
    }


    public function edit() {
        $authUser = User::find(auth()->id());

        return view('profile-edit-form', ['authUser' => $authUser]);
    }


    public function editCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
                'country' => 'required|min:3|max:25',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator->errors());
        }

        $authUser = User::find(auth()->id());

        if ($authUser->name == request()->get('name')
            && $authUser->country->name == request()->get('country')) {
            return redirect()
                ->route('profile')
                ->with('nothing to update', 'Nothing to update!');
        }

        if (Hash::check(request()->get('password'), $authUser->password)) {
            $authUser->name = request()->get('name');

            if (Country::where('name', request()->get('country'))->first() == null) {
                $country = new Country();
                $country->name = request()->get('country');
                $country->continent_id = rand(1, 7);
                $country->save();
                $authUser->country_id = $country->id;
            } else $authUser->country_id = Country::where('name', request()->get('country'))->first()->id;

            $authUser->save();
        } else {
            return redirect()
                ->route('profile.edit')
                ->with('password does not match', 'Password does not match');
        }

        return redirect()
            ->route('profile')
            ->with('success profile edit', 'Your profile data was successfully updated');
    }
}
