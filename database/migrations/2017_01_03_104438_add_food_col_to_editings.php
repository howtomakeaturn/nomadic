<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFoodColToEditings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('editings', function($t){
            $t->boolean('has_dessert')->after('url')->nullable();
            $t->boolean('has_meal')->after('has_dessert')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('editings', function($t){
            $t->dropColumn('has_dessert');
            $t->dropColumn('has_meal');
        });
    }

}
