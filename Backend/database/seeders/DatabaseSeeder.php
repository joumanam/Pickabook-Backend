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
        $user->first_name = "Joumana";
        $user->last_name = "Moussa";
        $user->email = "joum@se.io";
        $user->password = bcrypt("password");
        $user->role = "admin";
        $user->save();


        $user = new User();
        $user->first_name = "Charbel";
        $user->last_name = "Daoud";
        $user->email = "char@se.io";
        $user->password = bcrypt("password");
        $user->role = "admin";
        $user->save();


        $user = new User();
        $user->first_name = "Yvona";
        $user->last_name = "Nehme";
        $user->email = "yvee@se.io";
        $user->password = bcrypt("password");
        $user->role = "user";
        $user->save();


        $user = new User();
        $user->first_name = "Roxy";
        $user->last_name = "cat";
        $user->email = "roxy@se.io";
        $user->password = bcrypt("password");
        $user->role = "user";
        $user->save();


    }
}
