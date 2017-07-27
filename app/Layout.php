<?php

namespace App;

use Config;

class Layout
{

    private $city;

    private $cityNames = [];

    private $isMap = false;

    private $cafe;

    private $openGraphTitle;

    private $openGraphDescription;

    private $openGraphImage;

    private $displayNavbar = true;

    function __construct()
    {
        foreach (Config::get('city') as $key => $value) {
            $this->cityNames[$key] = $value['zh'];
        }
    }

    function setCafe($cafe)
    {
        $this->cafe = $cafe;

        $this->isMap = true;

        $this->city = $cafe->city;
    }

    function setCity($city)
    {
        $this->city = $city;
    }

    function getCity()
    {
        return $this->city;
    }

    function title()
    {
        if ($this->cafe ) return $this->cafe->name;

        return config('nomadic.homepage.title');
    }

    function slogan()
    {
        return config('nomadic.homepage.slogan-1');

        return trans('layout.slogan');
    }

    function setOpenGraphTitle($str)
    {
        $this->openGraphTitle = $str;
    }

    function openGraphTitle()
    {
        if ($this->openGraphTitle) return $this->openGraphTitle;

        return $this->title() . ' - ' . $this->slogan();
    }

    function setOpenGraphDescription($str)
    {
        $this->openGraphDescription = $str;
    }

    function openGraphDescription()
    {
        if ($this->openGraphDescription) return $this->openGraphDescription;

        return $this->openGraphTitle();
    }

    function setOpenGraphImage($str)
    {
        $this->openGraphImage = $str;
    }

    function openGraphImage()
    {
        if ($this->openGraphImage) return $this->openGraphImage;

        if ( $this->cafe && $this->cafe->validPhotos()->count() > 0 ) {
            return url('/upload_photos/width-600/'.$this->cafe->validPhotos()->first()->name);
        }

        if ( $this->cafe && $this->cafe->place_detail && $this->cafe->place_detail->response &&
            array_key_exists('photos', $this->cafe->place_detail->response['result']) )
        {
            $photo = $this->cafe->place_detail->response['result']['photos'][0];

            return generate_photo_url($photo['photo_reference'], 1000, 300);
        }

        if ($this->isMap && $this->city === 'taipei') {
            return url('/img/taipei-cafe-map.png');
        } else if ($this->isMap) {
            return url('/img/taichung-cafe-map.png');
        } else {
            return url('/img/taipei-cafe-list.png');
        }
    }

    function setIsMap($bool)
    {
        $this->isMap = $bool;
    }

    function getIsMap()
    {
        return $this->isMap;
    }

    function shouldShowTopNotice()
    {
        if ($this->city) {
            return true;
        } else {
            return false;
        }
    }

    static function isMobile()
    {
        $agent = new \Jenssegers\Agent\Agent();

        return $agent->isMobile();
    }

    function setDisplayNavbar($bool)
    {
        $this->displayNavbar = $bool;
    }

    function shouldDisplayNavbar()
    {
        return $this->displayNavbar;
    }

}
