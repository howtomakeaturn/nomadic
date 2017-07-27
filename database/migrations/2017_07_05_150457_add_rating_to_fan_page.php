<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingToFanPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_fan_pages', function($t){
            $t->float('overall_star_rating', 2, 1)->after('cafe_id');
            $t->integer('rating_count')->after('overall_star_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_fan_pages', function($t){
            $t->dropColumn('overall_star_rating');
            $t->dropColumn('rating_count');
        });
    }
}
