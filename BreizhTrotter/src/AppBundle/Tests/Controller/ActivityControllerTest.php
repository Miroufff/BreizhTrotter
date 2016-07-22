<?php

namespace AppBundle\Tests\Controller;

use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class ActivityControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client = null;

    private $em;
    private $application;


    public function setUp()
    {
    }

    public function testRedirectLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    public function testRedirectLogout()
    {
        $this->doLogin("admin", "admin");
        $crawler = $this->client->request('GET', '/');
        $crawler = $this->client->click($crawler->selectLink('Déconnexion')->link());
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isRedirect());
    }

    public function doLogin($username, $password) {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username'  => $username,
            '_password'  => $password,
        ));

        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect());

        $crawler = $this->client->followRedirect();
    }

    public function testCompleteScenario()
    {
        $this->doLogin("admin", "admin");

        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/scenario/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /scenario/");
        $crawler = $this->client->click($crawler->selectLink('Créer un nouveau scenario')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'appbundle_scenario[author]'      => 'Test',
            'appbundle_scenario[zone]'        => 'Test',
            'appbundle_scenario[content]'     => 'Test',
            'appbundle_scenario[name]'        => 'Test',
            'appbundle_scenario[description]' => 'Test',
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Create a new entry in the database
        $crawler = $this->client->click($crawler->selectLink('Ajouter une activité')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'appbundle_activity[day]'         => 'Test',
            'appbundle_activity[name]'        => 'activity',
            'appbundle_activity[description]' => 'Test',
            'appbundle_activity[feasibility]' => 1,
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $crawler = $this->client->click($crawler->selectLink('activity')->link());

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Modifier')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Modifier')->form(array(
            'appbundle_activity[name]'  => 'Mirouf',
            // ... other fields to fill
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('[value="Mirouf"]')->count(), 'Missing element td:contains("Mirouf")');

        // Delete the entity
        $this->client->submit($crawler->selectButton('Supprimer')->form());
        $crawler = $this->client->followRedirect();

        // Delete the entity
        $this->client->submit($crawler->selectButton('Supprimer')->form());
        $crawler = $this->client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $this->client->getResponse()->getContent());
    }
}
