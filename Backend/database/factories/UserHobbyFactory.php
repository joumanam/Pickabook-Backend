<?php

namespace Database\Factories;

use App\Models\UserHobby;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserHobbyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserHobby::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
