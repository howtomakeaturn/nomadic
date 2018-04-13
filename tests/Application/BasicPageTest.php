<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BasicPageTest extends TestCase
{
    use DatabaseMigrations;

    public function test_homepage()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }

    public function test_contribute_page()
    {
        $response = $this->call('GET', '/contribute');

        $this->assertEquals(302, $response->status());
    }

}
