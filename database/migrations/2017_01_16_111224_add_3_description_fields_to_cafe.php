<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add3DescriptionFieldsToCafe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->string('limited_time_description')->after('limited_time');
            $t->string('socket_description')->after('socket');
            $t->string('standing_desk_description')->after('standing_desk');
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
            $t->dropColumn('limited_time_description');
            $t->dropColumn('socket_description');
            $t->dropColumn('standing_desk_description');
        });
    }
}
