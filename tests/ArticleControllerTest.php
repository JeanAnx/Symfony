<?php

namespace App\Tests;

use App\Utils\Congratulator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/article');


        $this->assertSame(200, $client->getResponse()->getStatusCode());

        return $client;
    }

    /**
     * @depends testIndex
     */
    public function testCreateArticle(Client $client)
    {
        $client->request('GET', '/admin/create');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        // On passe le texte du bouton vvv
        $client->submitForm('Create',[
            'article[title]' => 'John Blake AKA Robin',
            'article[content]' => "Breathe in your fears. Face them. To conquer fear, you must become fear. You must bask in the fear of other men. And men fear most what they cannot see. You have to become a terrible thought. A wraith. You have to become an idea! Feel terror cloud your senses. Feel its power to distort. To control. And know that this power can be yours. Embrace your worst fear. Become one with the darkness.
",
            'article[status]' => true,
            'article[author]' => 5,
        ]);

        $this->assertSame(302 , $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertSame('/article' , $client->getRequest()->getPathInfo());

    }
}
