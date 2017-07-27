<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbFanPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_fan_pages', function($t){
            $t->string('id');
            $t->string('cafe_id');
            $t->timestamps();

            $t->primary('id');
        });

        Schema::create('fb_feeds', function($t){
            $t->string('id');
            $t->string('fb_fan_page_id');
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
        Schema::drop('fb_fan_pages');
        Schema::drop('fb_feeds');
    }

}
