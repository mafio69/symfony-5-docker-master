<?php

namespace App\Tests\FunctionalTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class firstTest extends WebTestCase
{
    public function testFirst()
    {
        $this->assertEquals(42, 42);
    }

    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/post/hello-world');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}