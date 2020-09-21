<?php

namespace Database\Seeders;

use App\Models\Continent;
use App\Models\Country;
use App\Models\Label;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Continent::factory()->count(7)->create()->each(function ($continent) {
            Country::factory()->count(rand(3, 8))->create(['continent_id' => $continent->id])->each(function ($country) {
                $users = User::factory()->count(rand(5, 10))->create(['country_id' => $country->id])->each(function ($user) {
                    $projects = Project::factory()->count(3)->create()->each(function ($project) use ($user) {
                        $project->users()->attach($user->id, ['is_creator' => rand(0, 1)]);
                        Label::factory()->count(2)->create()->each(function ($label) use ($project) {
                            $label->projects()->attach($project->id, ['is_creator' => rand(0, 1)]);
                        });
                    });
                });
            });
        });
    }
}
