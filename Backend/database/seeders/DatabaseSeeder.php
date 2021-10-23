<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AddBook;
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

        $user = new AddBook();
        $user->user_id = 1;
        $user->title = "Murder on the Orient Express";
        $user->author = "Agatha Christie";
        $user->category = "Thriller, mystery";
        $user->language = "English";
        $user->status = "Idle";
        $user->price = null;
        $user->condition = "good";
        $user->image_url = "image_url";
        $user->rating = "4 stars";
        $user->save();

        $user = new AddBook();
        $user->user_id = 2;
        $user->title = "Death on the Nile";
        $user->author = "Agatha Christie";
        $user->category = "Thriller, mystery";
        $user->language = "English";
        $user->condition = "very good";
        $user->status = "For Trade";
        $user->image_url = "image_url";
        $user->price = null;
        $user->rating = "4 stars";
        $user->save();

        $user = new AddBook();
        $user->user_id = 3;
        $user->title = "1984";
        $user->author = "Georges Orwell";
        $user->category = "Dystopian";
        $user->language = "English";
        $user->condition = "very good";
        $user->image_url = "image_url";
        $user->status = "For Sale";
        $user->price = "110,000 LL";
        $user->rating = "4 stars";
        $user->save();

        $user = new AddBook();
        $user->user_id = 1;
        $user->title = "Black Holes: The Reith Lectures";
        $user->author = "Stephen Hawking";
        $user->category = "Science, Physics, Non-fiction";
        $user->language = "English";
        $user->condition = "New";
        $user->image_url = "image_url";
        $user->status = "For Sale";
        $user->price = "120,000 LL";
        $user->rating = "4 stars";
        $user->save();


        $user = new AddBook();
        $user->user_id = 2;
        $user->title = "Discourse On Method And The Meditations";
        $user->author = "Descartes";
        $user->category = "Philosophy";
        $user->language = "English";
        $user->condition = "New";
        $user->image_url = "image_url";
        $user->status = "For Auction";
        $user->price = null;
        $user->rating = "3.8 stars";
        $user->save();


        $user = new AddBook();
        $user->user_id = 3;
        $user->title = "L'étranger";
        $user->author = "Albert Camus";
        $user->category = "Existential Fiction, Novel";
        $user->language = "French";
        $user->condition = "used, good condition";
        $user->image_url = "image_url";
        $user->status = "For Trade";
        $user->price = null;
        $user->rating = "4 stars";
        $user->save();


        $user = new AddBook();
        $user->user_id = 4;
        $user->title = "Caligula";
        $user->author = "Albert Camus";
        $user->category = "Theatre, Literature";
        $user->language = "French";
        $user->condition = "New";
        $user->image_url = "image_url";
        $user->status = "For Trade";
        $user->price = null;
        $user->rating = "4 stars";
        $user->save();


        $user = new AddBook();
        $user->user_id = 1;
        $user->title = "You Don’t Know JS Yet: Get Started";
        $user->author = "Kyle Simpson";
        $user->category = "Tech, Educational";
        $user->language = "English";
        $user->condition = "used";
        $user->image_url = "image_url";
        $user->status = "For Sale";
        $user->price = "100,000 LL";
        $user->rating = "3 stars";
        $user->save();


        $user = new AddBook();
        $user->user_id = 4;
        $user->title = "Eloquent Ruby";
        $user->author = "Russ Olsen ";
        $user->category = "Tech, Educational";
        $user->language = "English";
        $user->condition = "New";
        $user->image_url = "image_url";
        $user->status = "Idle";
        $user->price = null;
        $user->rating = "4 stars";
        $user->save();


    }
}
