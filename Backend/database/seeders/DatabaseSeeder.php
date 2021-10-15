<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserConnection;
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
        // \App\Models\User::factory(10)->create();

        $user = new User();
        $user->first_name = "admin";
        $user->last_name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("password");
        $user->role = "Admin";
        $user->save();

        // User::factory(10)->has(UserConnection::factory(5), "connectionsOne")
        //     ->has(UserConnection::factory(5), "connectionsTwo")
        //     ->hasHobbies(10)
        //     ->hasInterests(10)
        //     ->create();
    }
}
