<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:25
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Equipment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEquipmentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $equipment = new Equipment();
        $equipment->setName("Wifi");
        $equipment->addActivities($em->merge($this->getReference('activity-j1')));

        $equipment2 = new Equipment();
        $equipment2->setName("Panier");
        $equipment2->addActivities($em->merge($this->getReference('activity-j2M')));

        $equipment3 = new Equipment();
        $equipment3->setName("Bière");
        $equipment3->addActivities($em->merge($this->getReference('activity-j2A')));

        $equipment4 = new Equipment();
        $equipment4->setName("Couvert");
        $equipment4->addActivities($em->merge($this->getReference('activity-j2A')));

        $equipment5 = new Equipment();
        $equipment5->setName("Ceintre");
        $equipment5->addActivities($em->merge($this->getReference('activity-j2S')));

        $em->persist($equipment);
        $em->persist($equipment2);
        $em->persist($equipment3);
        $em->persist($equipment4);
        $em->persist($equipment5);
        $em->flush();
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 6;
    }
}