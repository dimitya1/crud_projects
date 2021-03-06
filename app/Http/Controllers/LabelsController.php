<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Collection;

final class LabelsController
{
    public function get()
    {
        $labels = collect();

        if(auth()->user() !== null) {
            foreach (auth()->user()->projects as $project) {
                foreach ($project->labels as $label) {
                    $labels->prepend($label);
                }
            }

            foreach (auth()->user()->labels as $label) {
                $labels->prepend($label);
            }
        }

        return view('labels', ['labels' => $labels->unique('id')]);
    }


    public function delete($id = null)
    {
        $label = Label::find($id);

        $label->delete();

        return back()
            ->with('successful label delete', "Label \"{$label->name}\" was successfully deleted!");
    }


    public function create()
    {
        return view('label-form');
    }


    public function save()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required|min:3|max:55',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('label.create')
                ->withErrors($validator->errors());
        }

        $label = new Label();
        $label->name = request()->get('name');
        $label->user_id = auth()->id();
        $label->save();

        return redirect()
            ->route('labels')
            ->with('successful label create', "Label \"{$label->name}\" was successfully created");
    }
}

