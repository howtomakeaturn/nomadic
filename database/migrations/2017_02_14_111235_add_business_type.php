<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->string('business_type')->after('standing_desk_description');
        });
        Schema::table('editings', function($t){
            $t->string('business_type')->after('standing_desk');
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
            $t->dropColumn('business_type');
        });
        Schema::table('editings', function($t){
            $t->dropColumn('business_type');
        });
    }
}
