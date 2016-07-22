<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConstraintControllerTest extends WebTestCase
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
        $crawler = $this->client->click($crawler->selectLink('Ajouter une contrainte')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'appbundle_constraint[numero]'            => 'C1',
            'appbundle_constraint[step]'              => 'Test',
            'appbundle_constraint[diffLevel]'         => 1,
            'appbundle_constraint[name]'              => 'truc',
            'appbundle_constraint[associateAction]'   => 'Test',
            'appbundle_constraint[context]'           => 'Test',
            'appbundle_constraint[description]'       => 'Test',
            'appbundle_constraint[mobilityEquipment]' => 'Test',
            'appbundle_constraint[personInCharge]'    => 'Test',
            'appbundle_constraint[diagAction]'        => 'Test',
            'appbundle_constraint[viabilityImpact]'   => 0,
            'appbundle_constraint[tourismImpact]'     => 1,
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $crawler = $this->client->click($crawler->selectLink('C1')->link());

        // Check data in the show view
        //$this->assertGreaterThan(0, $crawler->filter('[value="truc"]')->count(), 'Missing element td:contains("truc")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Modifier')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Modifier')->form(array(
            'appbundle_constraint[name]' => 'Mirouf',
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
