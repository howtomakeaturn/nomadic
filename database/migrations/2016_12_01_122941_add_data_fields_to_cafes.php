<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataFieldsToCafes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->string('url')->after('city');
            $t->text('note')->after('city');
            $t->string('who')->after('city');
            $t->string('standing_desk')->after('city');
            $t->string('socket')->after('city');
            $t->string('limited_time')->after('city');
            $t->string('parking')->after('city');
            $t->string('distance')->after('city');
            $t->string('mrt')->after('city');
            $t->string('address')->after('city');
            $t->string('area')->after('city');
            $t->string('open_time')->after('city');
            $t->string('music')->after('city');
            $t->string('cheap')->after('city');
            $t->string('tasty')->after('city');
            $t->string('quiet')->after('city');
            $t->string('seat')->after('city');
            $t->string('wifi')->after('city');
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
            $t->dropColumn('url');
            $t->dropColumn('note');
            $t->dropColumn('who');
            $t->dropColumn('standing_desk');
            $t->dropColumn('socket');
            $t->dropColumn('limited_time');
            $t->dropColumn('parking');
            $t->dropColumn('distance');
            $t->dropColumn('mrt');
            $t->dropColumn('address');
            $t->dropColumn('area');
            $t->dropColumn('open_time');
            $t->dropColumn('music');
            $t->dropColumn('cheap');
            $t->dropColumn('tasty');
            $t->dropColumn('quiet');
            $t->dropColumn('seat');
            $t->dropColumn('wifi');
        });
    }

}
