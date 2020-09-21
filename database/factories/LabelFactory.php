<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LabelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Label::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(20),
        ];
    }
}
