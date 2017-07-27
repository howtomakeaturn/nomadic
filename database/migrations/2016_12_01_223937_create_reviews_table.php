<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function($t){
            $t->increments('id');
            $t->string('cafe_id');
            $t->integer('wifi');
            $t->integer('seat');
            $t->integer('quiet');
            $t->integer('tasty');
            $t->integer('cheap');
            $t->integer('music');
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
        Schema::drop('reviews');
    }

}
