<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableOnEditings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $target_fields = ['name', 'url', 'limited_time', 'socket',
        'standing_desk', 'business_type', 'open_time', 'mrt', 'address'];

    public function up()
    {
        Schema::table('editings', function($t){
            foreach ($this->target_fields as $field) {
                $t->string($field)->nullable()->change();
            }

            $t->decimal('latitude', 10, 8)->nullable()->change();
            $t->decimal('longitude', 11, 8)->nullable()->change();
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
            foreach ($this->target_fields as $field) {
                $t->string($field)->nullable(false)->change();
            }

            $t->decimal('latitude', 10, 8)->nullable(false)->change();
            $t->decimal('longitude', 11, 8)->nullable(false)->change();
        });
    }
}
