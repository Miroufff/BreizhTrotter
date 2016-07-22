<?php

namespace AppBundle\Tests\Controller;

use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class ActionControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client = null;


    public function setUp()
    {
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

        // Create a new entry in the database
        $crawler = $this->client->click($crawler->selectLink('Ajouter une action')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'appbundle_action[numero]'              => 'A1',
            'appbundle_action[step]'                => 'Test',
            'appbundle_action[feasibility]'         => 1,
            'appbundle_action[name]'                => 'truc',
            'appbundle_action[associateConstraint]' => 'Test',
            'appbundle_action[personInCharge]'      => 'Test',
            'appbundle_action[description]'         => 'Test',
            'appbundle_action[experienceTourism]'   => 'Test',
            'appbundle_action[sustainableMobility]' => 'Test',
            'appbundle_action[mobilityEquipment]'   => 'Test',
            'appbundle_action[involvedActor]'       => 'Test',
            'appbundle_action[deliverable]'         => 'Test',
            'appbundle_action[budget]'              => 'Test',
            'appbundle_action[vigilancePoint]'      => 'Test',
            'appbundle_action[accomplishment]'      => 0,
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $crawler = $this->client->click($crawler->selectLink('A1')->link());

        // Check data in the show view
        //$this->assertGreaterThan(0, $crawler->filter('[value="truc"]')->count(), 'Missing element td:contains("truc")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Modifier')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Modifier')->form(array(
            'appbundle_action[name]'  => 'Mirouf',
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

        // Delete the entity
        $this->client->submit($crawler->selectButton('Supprimer')->form());
        $crawler = $this->client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $this->client->getResponse()->getContent());
    }
}
