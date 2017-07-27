<?php

use Illuminate\Database\Seeder;
use App\Cafe;

class CafeTableRawDataSeeder extends Seeder
{

    private function generateCafeData($fields, $file)
    {
        $cafes = [];

        while (($line = fgetcsv($file)) !== FALSE) {
            if ($line[1] == '請去過的人評分') {
                $line[1] = '';
            }

            $cafes[] = change_cafe_key($line, $fields);
        }

        fclose($file);

        unset($cafes[0]);

        return $cafes;
    }

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

         $this->command->info('raw data~');
     }

     function executeCity($city)
     {
         $fields = Config::get("city.$city");

         $file = fopen(storage_path("app/2016-11-27-11-47/$city.csv"), 'r');

         $cafes = $this->generateCafeData($fields, $file);

         foreach ($cafes as $c) {
             $uuid = get_uuid($c['name']);

             $cafe = Cafe::find($uuid);

             if (!$cafe) continue;

             $cafe->wifi = $c['wifi'];

             $cafe->seat = $c['seat'];

             $cafe->quiet = $c['quiet'];

             $cafe->tasty = $c['tasty'];

             $cafe->cheap = $c['cheap'];

             $cafe->music = $c['music'];

             if (array_key_exists('distance', $c)) $cafe->distance = $c['distance'];

             if (array_key_exists('open-time', $c)) $cafe->open_time = $c['open-time'];

             if (array_key_exists('mrt', $c)) $cafe->mrt = $c['mrt'];

             if (array_key_exists('address', $c)) $cafe->address = $c['address'];

             if (array_key_exists('limited-time', $c)) $cafe->limited_time = $c['limited-time'];

             if (array_key_exists('socket', $c)) $cafe->socket = $c['socket'];

             if (array_key_exists('standing-desk', $c)) $cafe->standing_desk = $c['standing-desk'];

             if (array_key_exists('who', $c)) $cafe->who = $c['who'];

             if (array_key_exists('note', $c)) $cafe->note = $c['note'];

             if (array_key_exists('url', $c)) $cafe->url = $c['url'];

             if (array_key_exists('area', $c)) $cafe->area = $c['area'];

             if (array_key_exists('parking', $c)) $cafe->parking = $c['parking'];

             $cafe->save();

             $this->command->info('update: ' . $cafe->name);
         }
     }

}
