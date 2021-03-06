<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('add_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onDelete("cascade");
            $table->string('title');
            $table->string('author');
            $table->string('category');
            $table->string('language');
            $table->string('condition');
            $table->string('image_url');
            $table->string('price')->nullable();
            $table->string('rating');
            $table->string('status')->default('Idle');
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
        Schema::dropIfExists('user_addBooks');
    }
}
