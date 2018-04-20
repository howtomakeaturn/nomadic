<?php

namespace App;

class VerifyNewCafe
{

    function handle()
    {
        $cafe = Cafe::where('status', Cafe::CREATED_STATUS)
            ->where('address', '!=', '')
            ->where('city', '!=', '')
            ->orderBy('created_at', 'asc')
            ->first();

        if (!$cafe) return;

        try {

            $this->setCoordinate($cafe);

            $this->checkDuplicate($cafe);

            $cafe->status = Cafe::APPROVED_STATUS;

            $cafe->save();

            return $cafe;

        } catch ( \Exception $e ) {
            $cafe->status = Cafe::ISSUE_STATUS;

            $cafe->save();
        }

    }

    function setCoordinate($cafe)
    {
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json' . '?'. http_build_query([
            'address' => $cafe->address,
            'key' => 'AIzaSyC7eLWJImaOxx8h8cevI2Lyl53-pfxUVGk'
        ]));

        $geo = json_decode($geo);

        $lat = $geo->results[0]->geometry->location->lat;

        $lng = $geo->results[0]->geometry->location->lng;

        $cafe->latitude = $lat;

        $cafe->longitude = $lng;

        $cafe->status = Cafe::APPROVED_STATUS;
    }

    function checkDuplicate($cafe)
    {
        $cafes = Cafe::orderBy('created_at', 'desc')
            ->where('status', '>=', '0')
            ->where('longitude', '!=', '0')
            ->where('latitude', '!=', '0')
            ->get();

        $result = [];

        $geotools = new \League\Geotools\Geotools();

        foreach ($cafes as $c) {
            if ($cafe->id === $c->id) continue;

            $coordA   = new \League\Geotools\Coordinate\Coordinate([$cafe->latitude, $cafe->longitude]);
            $coordB   = new \League\Geotools\Coordinate\Coordinate([$c->latitude, $c->longitude]);
            $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);
            $d = $distance->flat();
            if ($d < 10) {
                throw new \Exception('duplicate possible');
            }
        }
    }

}
