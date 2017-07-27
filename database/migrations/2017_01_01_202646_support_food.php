<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupportFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->integer('food')->after('music');
            $t->boolean('has_dessert')->after('food')->nullable();
            $t->boolean('has_meal')->after('has_dessert')->nullable();
        });

        Schema::table('reviews', function($t){
            $t->integer('food')->after('music');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafes', function($t){
            $t->dropColumn('food');
            $t->dropColumn('has_dessert');
            $t->dropColumn('has_meal');
        });

        Schema::table('reviews', function($t){
            $t->dropColumn('food');
        });
    }
}
