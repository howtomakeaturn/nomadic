<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGooglePlaceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_place_details', function($t){
            $t->string('google_id');
            $t->string('place_id');
            $t->string('cafe_id');
            $t->text('response');
            $t->timestamps();

            $t->primary('cafe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('google_place_details');
    }

}
