<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'pa$$word',
        ));

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Rechercher un utilisateur GitHub', $crawler->filter('.panel-heading')->text());
    }

    public function testComment()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'pa$$word',
        ));

        $crawler = $client->request('GET', '/GuillaumeCo/comment');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Commentaires pour les dépots de GuillaumeCo', $crawler->filter('h2')->text());
    }
}
