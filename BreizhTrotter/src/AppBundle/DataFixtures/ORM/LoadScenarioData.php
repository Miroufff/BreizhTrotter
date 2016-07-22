<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:21
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Scenario;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadScenarioData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $scenario = new Scenario();
        $scenario->setAuthor("Mirouf");
        $scenario->setDescription("Un court séjour packagé « Week-end Grandes Marées » pour couples parisiens arrivant en gare de St-Malo, 2 jours + 2 nuits, en Mars ou Septembre, incluant hôtellerie, restauration, activités, moyens de transport.");
        $scenario->setName("Week-end Grandes Marées pour couple parisien – 2J 2N – Mars ou Sept.");
        $scenario->setContent("Nature spectaculaire, Cocooning, Détente, Gastronomie, Shopping");
        $scenario->setZone("Est-Ouest : Cancale à Dinard / Nord-Sud : Littoral à Dol-de-Bretagne");
        $scenario->setOpen(0);

        $scenario2 = new Scenario();
        $scenario2->setAuthor("Mirouf");
        $scenario2->setDescription("Un court séjour packagé « Week-end Grandes Marées » pour couples parisiens arrivant en gare de St-Malo, 2 jours + 2 nuits, en Mars ou Septembre, incluant hôtellerie, restauration, activités, moyens de transport.");
        $scenario2->setName("Week-end Grandes Marées pour couple parisien – 2J 2N – Mars ou Sept.");
        $scenario2->setContent("Nature spectaculaire, Cocooning, Détente, Gastronomie, Shopping");
        $scenario2->setZone("Est-Ouest : Cancale à Dinard / Nord-Sud : Littoral à Dol-de-Bretagne");

        $em->persist($scenario);
        $em->persist($scenario2);
        $em->flush();

        $this->addReference('scenario-open', $scenario);
        $this->addReference('scenario-close', $scenario2);
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 1;
    }
}