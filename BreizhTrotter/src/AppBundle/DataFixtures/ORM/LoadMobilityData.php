<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:25
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Mobility;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMobilityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $mobility = new Mobility();
        $mobility->setName("Voiture");
        $mobility->addActivities($em->merge($this->getReference('activity-j1')));
        $mobility->addActivities($em->merge($this->getReference('activity-j2M')));
        $mobility->addActivities($em->merge($this->getReference('activity-j2A')));

        $mobility2 = new Mobility();
        $mobility2->setName("A pied");
        $mobility2->addActivities($em->merge($this->getReference('activity-j2S')));

        $em->persist($mobility);
        $em->persist($mobility2);
        $em->flush();
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 5;
    }
}