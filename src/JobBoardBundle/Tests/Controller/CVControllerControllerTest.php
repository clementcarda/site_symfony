<?php

namespace JobBoardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CVControllerControllerTest extends WebTestCase
{
    public function testShowcv()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cv');
    }

}
