<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\AddBook;
use Illuminate\Database\Seeder;

class AddBooksSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = new AddBook();
        // $user->user_id = rand(1,10);
        // $user->title = "Murder on the Orient Express";
        // $user->author = "Agatha Christie";
        // $user->category = "Thriller, mystery";
        // $user->language = "English";
        // $user->price = null;
        // $user->condition = "good";
        // $user->image_url = "image_url";
        // $user->rating = "4 stars";

        $user = new AddBook();
        $user->user_id = rand(1,10);
        $user->title = "Death on the Nile";
        $user->author = "Agatha Christie";
        $user->category = "Thriller, mystery";
        $user->language = "English";
        $user->condition = "very good";
        $user->image_url = "image_url";
        $user->price = "130,000 LL";
        $user->rating = "4 stars";


        $user->save();



        // User::factory(10)->has(UserConnection::factory(5), "connectionsOne")
        //     ->has(UserConnection::factory(5), "connectionsTwo")
        //     ->hasHobbies(10)
        //     ->hasInterests(10)
        //     ->create();
    }
}
