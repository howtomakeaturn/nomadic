<?php

namespace App\Editing;

use Config;
use App\Editing;

class Presenter
{

    protected $editing;

    public function __construct(Editing $editing)
    {
        $this->editing = $editing;
    }

    function hasWifi()
    {
        if ($this->editing->has_wifi === true) return 'Yes';

        if ($this->editing->has_wifi === false) return 'No';

        return '';
    }

    function hasSingleOrigin()
    {
        if ($this->editing->has_single_origin === true) return 'Yes';

        if ($this->editing->has_single_origin === false) return 'No';

        return '';
    }

    function hasDessert()
    {
        if ($this->editing->has_dessert === true) return 'Yes';

        if ($this->editing->has_dessert === false) return 'No';

        return '';
    }

    function hasMeal()
    {
        if ($this->editing->has_meal === true) return 'Yes';

        if ($this->editing->has_meal === false) return 'No';

        return '';
    }

}
