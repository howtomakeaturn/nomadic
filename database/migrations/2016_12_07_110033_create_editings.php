<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editings', function($t){
            $t->increments('id');

            $t->string('cafe_id');

            $t->string('name');
            $t->string('url');

            $t->string('limited_time');
            $t->string('socket');
            $t->string('standing_desk');

            $t->string('open_time');
            $t->string('address');

            $t->decimal('latitude', 10, 8);
            $t->decimal('longitude', 11, 8);

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
        Schema::drop('editings');
    }
}
