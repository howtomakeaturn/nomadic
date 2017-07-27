<?php

use Illuminate\Database\Seeder;
use App\Cafe;

class CafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->executeCity('taipei');

        $this->executeCity('taichung');

        $this->executeCity('tainan');

        $this->executeCity('kaohsiung');

        $this->command->info('good');
    }

    function executeCity($city)
    {
        $rows = [];

        $file = fopen(storage_path("app/uuids/$city.csv"), 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            $rows[] = $line;
        }

        fclose($file);

        foreach ($rows as $row) {
            $name = trim($row[0]);

            $id = $row[1];

            if (!Cafe::find($id)) {
                $cafe = new Cafe();

                $cafe->id = $id;

                $cafe->name = $name;

                $cafe->city = $city;

                $cafe->latitude = 0;

                $cafe->longitude = 0;

                $cafe->save();

                $this->command->info('Inserted: ' . $name);
            }
        }
    }

}
