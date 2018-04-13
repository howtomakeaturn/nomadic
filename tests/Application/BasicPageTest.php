<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Entity;

class BasicPageTest extends TestCase
{
    use DatabaseMigrations;

    function insertSomeEntities()
    {
        $this->insertEntity(md5(uniqid()));

        $this->insertEntity(md5(uniqid()));

        $this->insertEntity(md5(uniqid()));
    }

    function insertEntity($name)
    {
        $city = array_keys(config('city'))[0];

        $entity = new Entity();

        $entity->id = \Ramsey\Uuid\Uuid::uuid4()->toString();

        $entity->name = $name;

        $entity->city = $city;

        $entity->status = Entity::APPROVED_STATUS;

        $entity->save();
    }

    function setUp()
    {
        parent::setUp();

        $this->insertSomeEntities();
    }

    function test_homepage()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }

    function test_contribute_page()
    {
        $response = $this->call('GET', '/contribute');

        $this->assertEquals(302, $response->status());
    }

    function test_list_page()
    {
        $city = array_keys(config('city'))[0];

        $name = md5(uniqid());

        $this->insertEntity($name);

        $this->visit("/$city/list")
            ->see($name);
    }

    function test_city_homepage()
    {
        $city = array_keys(config('city'))[0];

        $response = $this->call('GET', "/$city");

        $this->visit("/$city")
            ->see('<span class="green">3</span>');
    }

}
