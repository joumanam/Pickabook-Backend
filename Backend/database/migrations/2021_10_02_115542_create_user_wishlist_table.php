<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWishlistTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user_wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onDelete("cascade");
            $table->string('title');
            $table->string('author');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('user_wishlists');
    }
}
