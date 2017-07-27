<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBasicGuideFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->boolean('is_starred')->after('opening_date');
        });

        Schema::table('profiles', function($t){
            $t->boolean('is_sponsored')->after('score');
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
            $t->dropColumn('is_starred');
        });

        Schema::table('profiles', function($t){
            $t->dropColumn('is_sponsored');
        });
    }
}
