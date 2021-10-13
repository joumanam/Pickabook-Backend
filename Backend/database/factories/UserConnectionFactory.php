<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserConnection;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserConnectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserConnection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user1_id' => User::factory(),
            'user2_id' => User::factory(),
            'response' => $this->faker->numberBetween(0, 1),
        ];
    }
}
