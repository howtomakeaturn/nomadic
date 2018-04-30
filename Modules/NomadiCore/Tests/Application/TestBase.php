<?php

namespace Modules\NomadiCore\Tests\Application;

use TestCase;

class TestBase extends TestCase
{

    function setUp()
    {
        parent::setUp();

        config(['nomadic.map-enabled' => false]);

        config(['nomadic.business-hours-enabled' => false]);
    }

}
