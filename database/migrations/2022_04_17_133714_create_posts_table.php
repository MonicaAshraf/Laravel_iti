<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//represent SQl_Statment
    {
        Schema::create('posts', function (Blueprint $table) //1st parameter:Table_Name,2nd parameter:callback function=>represent Table_Columns 
        //, Blueprint => meaning class ,$table => object from blueprint class -->  use to call some methods
        {
            $table->id();// == unsigned big integer column + auto increment
            $table->string('title');// == varchar column
            $table->text('description');// == text column
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
