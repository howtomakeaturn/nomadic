<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportSnapshotV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(File::get(storage_path('app/schema-snapshot-v1.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ( DB::select('SHOW TABLES') as $table ) {
            $table_array = get_object_vars($table);
            if ($table_array[key($table_array)] === 'migrations') continue;
            Schema::drop($table_array[key($table_array)]);
        }
    }
}
