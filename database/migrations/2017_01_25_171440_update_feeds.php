<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_feeds', function($t){
            $t->timestamp('published_at')->after('fb_fan_page_id');
            $t->text('message')->after('fb_fan_page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_feeds', function($t){
            $t->dropColumn('published_at');
            $t->dropColumn('message');
        });
    }
}
