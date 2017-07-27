<?php

namespace App\Cafe;

use Config;
use App\Cafe;

class Api
{

    protected $cafe;

    public function __construct(Cafe $cafe)
    {
        $this->cafe = $cafe;
    }

    function v10()
    {
        return [
            'id' => $this->cafe->id,
            'name' => $this->cafe->name,
            'city' => $this->cafe->city,

            'wifi' => extractScore($this->cafe->wifi),
            'seat' => extractScore($this->cafe->seat),
            'quiet' => extractScore($this->cafe->quiet),
            'tasty' => extractScore($this->cafe->tasty),
            'cheap' => extractScore($this->cafe->cheap),
            'music' => extractScore($this->cafe->music),

            'url' => $this->cafe->url,
            'address' => $this->cafe->address,
            'latitude' => $this->cafe->latitude,
            'longitude' => $this->cafe->longitude
        ];
    }

    function v11()
    {
        return [
            'id' => $this->cafe->id,
            'name' => $this->cafe->name,
            'city' => $this->cafe->city,

            'wifi' => extractScore($this->cafe->wifi),
            'seat' => extractScore($this->cafe->seat),
            'quiet' => extractScore($this->cafe->quiet),
            'tasty' => extractScore($this->cafe->tasty),
            'cheap' => extractScore($this->cafe->cheap),
            'music' => extractScore($this->cafe->music),

            'url' => $this->cafe->url,
            'address' => $this->cafe->address,
            'latitude' => $this->cafe->latitude,
            'longitude' => $this->cafe->longitude,

            'limited_time' => $this->cafe->limited_time,
            'socket' => $this->cafe->socket,
            'standing_desk' => $this->cafe->standing_desk,
        ];
    }

    function v12()
    {
        return [
            'id' => $this->cafe->id,
            'name' => $this->cafe->name,
            'city' => $this->cafe->city,

            'wifi' => extractScore($this->cafe->wifi),
            'seat' => extractScore($this->cafe->seat),
            'quiet' => extractScore($this->cafe->quiet),
            'tasty' => extractScore($this->cafe->tasty),
            'cheap' => extractScore($this->cafe->cheap),
            'music' => extractScore($this->cafe->music),

            'url' => $this->cafe->url,
            'address' => $this->cafe->address,
            'latitude' => $this->cafe->latitude,
            'longitude' => $this->cafe->longitude,

            'limited_time' => $this->cafe->limited_time,
            'socket' => $this->cafe->socket,
            'standing_desk' => $this->cafe->standing_desk,

            'mrt' => $this->cafe->mrt,
            'open_time' => $this->cafe->open_time,
        ];
    }

}
