<?php

namespace Database\Factories;

use App\Models\Continent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContinentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Continent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $continents = collect([
            ['code' => 'AF', 'name' => 'Africa'],
            ['code' => 'AN', 'name' => 'Antarctica'],
            ['code' => 'AS', 'name' => 'Asia'],
            ['code' => 'EU', 'name' => 'Europe'],
            ['code' => 'NA', 'name' => 'North America'],
            ['code' => 'OC', 'name' => 'Oceania'],
            ['code' => 'SA', 'name' => 'South America'],
        ]);

        $continent = $continents->random();
        $continents = $continents->whereNotIn('code', $continent['code']);

        return [
            'code' => $continent['code'],
            'name' => $continent['name'],
        ];
    }
}
