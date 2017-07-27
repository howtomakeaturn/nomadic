<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCafes7CoreCoulmnsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function($t){
            $t->decimal('wifi', 2,1)->change();
            $t->decimal('seat', 2,1)->change();
            $t->decimal('quiet', 2,1)->change();
            $t->decimal('tasty', 2,1)->change();
            $t->decimal('food', 2,1)->change();
            $t->decimal('cheap', 2,1)->change();
            $t->decimal('music', 2,1)->change();
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
            $t->string('wifi')->change();
            $t->string('seat')->change();
            $t->string('quiet')->change();
            $t->string('tasty')->change();
            $t->string('food')->change();
            $t->string('cheap')->change();
            $t->string('music')->change();
        });
    }
}
