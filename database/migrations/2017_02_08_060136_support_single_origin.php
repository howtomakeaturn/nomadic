<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupportSingleOrigin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->boolean('has_single_origin')->after('food')->nullable();
        });

        Schema::table('editings', function($t){
            $t->boolean('has_single_origin')->after('url')->nullable();
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
            $t->dropColumn('has_single_origin');
        });

        Schema::table('editings', function($t){
            $t->dropColumn('has_single_origin');
        });
    }
}
