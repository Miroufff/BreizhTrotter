<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:24
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Activity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadActivityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $activity1 = new Activity();
        $activity1->setName("Départ pour Cancale. Déjeuner sur le port de Cancale.");
        $activity1->setDescription("Avec les bagages. Départ tôt pour profiter de la marée haute. Balade en Zoé le long de la côte. Arrivée à Cancale, vue sur la marée haute. Ballade. Déjeuner dégustation de fruits de mer Zoé louée en « AutoLib » sur une place proche de l’hébergement");
        $activity1->setDay("J1");
        $activity1->setFeasibility(2);
        $activity1->setScenario($em->merge($this->getReference('scenario-open')));

        $activity2 = new Activity();
        $activity2->setName("Marché de Dinard et shopping Expo Palais des Arts (si pluie)");
        $activity2->setDescription("Petit déjeuner tardif. L’hébergeur fourni parapluie si pluie. L’hébergeur s’assure que le couple à téléchargé l’appli. Déjeuner de dégustation dans un bar à huître. Balade sur la grande plage pour voir marée qui se retire.");
        $activity2->setDay("J2 Matin");
        $activity2->setFeasibility(2);
        $activity2->setScenario($em->merge($this->getReference('scenario-open')));

        $activity3 = new Activity();
        $activity3->setName("Circuit balisé sur la plage de Dinard ");
        $activity3->setDescription("L’appli mobile permet de se promener sur la plage, les hauteurs de Dinard, et de commenter les points d’intérêts et de guider le couple. ");
        $activity3->setDay("J2 Après-midi");
        $activity3->setFeasibility(0);
        $activity3->setScenario($em->merge($this->getReference('scenario-open')));

        $activity4 = new Activity();
        $activity4->setName("Saint-Malo Restaurant vue sur mer. Nuit à Dinard.");
        $activity4->setDescription("Voilier ou bateau-taxi de mer à l’aller. Retour idem ou taxi route selon la météo.Vue sur la marée haute sur la plage du Sillon à St Malo Le couple admire la marée haute et se fait un resto gastro.");
        $activity4->setDay("J2 Soir");
        $activity4->setFeasibility(2);
        $activity4->setScenario($em->merge($this->getReference('scenario-open')));

        $activity5 = new Activity();
        $activity5->setName("Départ pour Cancale. Déjeuner sur le port de Cancale.");
        $activity5->setDescription("Avec les bagages. Départ tôt pour profiter de la marée haute. Balade en Zoé le long de la côte. Arrivée à Cancale, vue sur la marée haute. Ballade. Déjeuner dégustation de fruits de mer Zoé louée en « AutoLib » sur une place proche de l’hébergement");
        $activity5->setDay("J3 Matin");
        $activity5->setFeasibility(1);
        $activity5->setScenario($em->merge($this->getReference('scenario-close')));

        $activity6 = new Activity();
        $activity6->setName("Train à Dol de Bretagne à 16h57 (avec les bagages)");
        $activity6->setDescription("Shopping de souvenirs pour ramener aux enfants. Départ en Zoé pour gare de Dol. Retour de la Zoé à la borne AutoLib de la gare de Dol");
        $activity6->setDay("J3 Après-midi");
        $activity6->setFeasibility(1);
        $activity6->setScenario($em->merge($this->getReference('scenario-close')));

        $em->persist($activity1);
        $em->persist($activity2);
        $em->persist($activity3);
        $em->persist($activity4);
        $em->persist($activity5);
        $em->persist($activity6);
        $em->flush();

        $this->addReference('activity-j1', $activity1);
        $this->addReference('activity-j2M', $activity2);
        $this->addReference('activity-j2A', $activity3);
        $this->addReference('activity-j2S', $activity4);
        $this->addReference('activity-j3M', $activity5);
        $this->addReference('activity-j3A', $activity6);
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 2;
    }
}