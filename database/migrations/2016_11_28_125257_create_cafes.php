<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafes', function($t){
            $t->string('id');
            $t->string('name');

            $t->string('city');

            $t->decimal('latitude', 10, 8);
            $t->decimal('longitude', 11, 8);

            $t->timestamps();

            $t->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cafes');
    }
}
