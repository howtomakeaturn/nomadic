<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsAndPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('discussions', function($t){
            $t->increments('id');
            $t->string('title');
        });

        Schema::create('posts', function($t){
            $t->increments('id');
            $t->text('content');
            $t->integer('user_id');
            $t->integer('discussion_id');
            $t->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discussions');
        Schema::drop('posts');
    }
}
