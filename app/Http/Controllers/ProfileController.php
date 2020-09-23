<?php

namespace App\Http\Controllers;
use App\Models\User;
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

    public function edit()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:4|max:75',
                'country' => 'required|min:3|max:25',
                'password' => 'required|min:4|max:75|regex:/[a-Z]/|regex:/[0-9]/',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator->errors());
        }

        $authUser = User::find(auth()->id());

//        if ($authUser->title == request()->get('title')
//            && $ad->description == request()->get('description')) {
//            return redirect()
//                ->route('home')
//                ->with('nothing to update', 'Nothing to update');
//        }

        $authUser->name = request()->get('name');
        $authUser->country = 33;
        $authUser->password = request()->get('password');
        $authUser->save();

        return redirect()
            ->route('home')
            ->with('success', 'Your profile data was successfully updated');
    }

//    public function delete($id = null)
//    {
//        $ad = \App\Ad::find($id);
//
//        $ad->delete();
//
//        return redirect()
//            ->route('home')
//            ->with('success', "Ad \"{$ad->title}\" was successfully deleted!");
//    }
}
