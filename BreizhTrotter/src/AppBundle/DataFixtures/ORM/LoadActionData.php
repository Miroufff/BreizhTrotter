<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:24
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Action;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadActionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $action1 = new Action();
        $action1->setNumero("A1");
        $action1->setStep("Tout le séjour");
        $action1->setFeasibility(1);
        $action1->setName("Identifier des hébergeurs partenaires");
        $action1->setAssociateConstraint("C1 / C2");
        $action1->setPersonInCharge("OT de Saint-Malo");
        $action1->setDescription("Identifier des hébergeurs qui:-correspondent aux critères du séjour,-souhaitent s’impliquer dans le groupe de travail BTG,-ont une borne de recharge électrique (ou en projets de travaux),-un service de taxi (ou équivalent) pour chercher le couple le vendredi soir à la gare de St Malo,soit bien impliqué avec les acteurs locaux pour proposer des activités ludiques et uniques en Mars etSept.");
        $action1->setExperienceTourism("Cocooning Vue sur mer");
        $action1->setSustainableMobility("Véhicule électrique Centre-ville");
        $action1->setMobilityEquipment("Borne/ Prisede rechargeTaxi ou service équivalent");
        $action1->setInvolvedActor("-OT et membres du groupe de travail BTG-hébergeurs volontaires-Renault Rent-Concessionnaire(s) local(ux)");
        $action1->setDeliverable("-Brochure des services et tarifs des hébergeurs volontaires-Liste de ou des hébergeurs retenus");
        $action1->setBudget(0);
        $action1->setTimeLimit(new \DateTime());
        $action1->setVigilancePoint("-S’assurer de l’engagement réel des hébergeurs-Impliquer les hébergeurs le plus tôt possible dans la réflexion");
        $action1->setAccomplishment(0);
        $action1->addActivities($em->merge($this->getReference('activity-j1')));

        $action2 = new Action();
        $action2->setNumero("A2");
        $action2->setStep("Tout le séjour");
        $action2->setFeasibility(1);
        $action2->setName("Identifier des hébergeurs partenaires");
        $action2->setAssociateConstraint("C1");
        $action2->setPersonInCharge("OT de Saint-Malo");
        $action2->setDescription("Identifier des hébergeurs qui:-correspondent aux critères du séjour,-souhaitent s’impliquer dans le groupe de travail BTG,-ont une borne de recharge électrique (ou en projets de travaux),-un service de taxi (ou équivalent) pour chercher le couple le vendredi soir à la gare de St Malo,soit bien impliqué avec les acteurs locaux pour proposer des activités ludiques et uniques en Mars etSept.");
        $action2->setExperienceTourism("Cocooning Vue sur mer");
        $action2->setSustainableMobility("Véhicule électrique Centre-ville");
        $action2->setMobilityEquipment("Borne/ Prisede rechargeTaxi ou service équivalent");
        $action2->setInvolvedActor("-OT et membres du groupe de travail BTG-hébergeurs volontaires-Renault Rent-Concessionnaire(s) local(ux)");
        $action2->setDeliverable("-Brochure des services et tarifs des hébergeurs volontaires-Liste de ou des hébergeurs retenus");
        $action2->setBudget(0);
        $action2->setTimeLimit(new \DateTime());
        $action2->setVigilancePoint("-S’assurer de l’engagement réel des hébergeurs-Impliquer les hébergeurs le plus tôt possible dans la réflexion");
        $action2->setAccomplishment(0);
        $action2->addActivities($em->merge($this->getReference('activity-j2M')));

        $action3 = new Action();
        $action3->setNumero("A3");
        $action3->setStep("Tout le séjour");
        $action3->setFeasibility(1);
        $action3->setName("Identifier des hébergeurs partenaires");
        $action3->setAssociateConstraint("C1");
        $action3->setPersonInCharge("OT de Saint-Malo");
        $action3->setDescription("Identifier des hébergeurs qui:-correspondent aux critères du séjour,-souhaitent s’impliquer dans le groupe de travail BTG,-ont une borne de recharge électrique (ou en projets de travaux),-un service de taxi (ou équivalent) pour chercher le couple le vendredi soir à la gare de St Malo,soit bien impliqué avec les acteurs locaux pour proposer des activités ludiques et uniques en Mars etSept.");
        $action3->setExperienceTourism("Cocooning Vue sur mer");
        $action3->setSustainableMobility("Véhicule électrique Centre-ville");
        $action3->setMobilityEquipment("Borne/ Prisede rechargeTaxi ou service équivalent");
        $action3->setInvolvedActor("-OT et membres du groupe de travail BTG-hébergeurs volontaires-Renault Rent-Concessionnaire(s) local(ux)");
        $action3->setDeliverable("-Brochure des services et tarifs des hébergeurs volontaires-Liste de ou des hébergeurs retenus");
        $action3->setBudget(0);
        $action3->setTimeLimit(new \DateTime());
        $action3->setVigilancePoint("-S’assurer de l’engagement réel des hébergeurs-Impliquer les hébergeurs le plus tôt possible dans la réflexion");
        $action3->setAccomplishment(0);
        $action3->addActivities($em->merge($this->getReference('activity-j2M')));

        $action4 = new Action();
        $action4->setNumero("A4");
        $action4->setStep("Tout le séjour");
        $action4->setFeasibility(1);
        $action4->setName("Identifier des hébergeurs partenaires");
        $action4->setAssociateConstraint("C2");
        $action4->setPersonInCharge("OT de Saint-Malo");
        $action4->setDescription("Identifier des hébergeurs qui:-correspondent aux critères du séjour,-souhaitent s’impliquer dans le groupe de travail BTG,-ont une borne de recharge électrique (ou en projets de travaux),-un service de taxi (ou équivalent) pour chercher le couple le vendredi soir à la gare de St Malo,soit bien impliqué avec les acteurs locaux pour proposer des activités ludiques et uniques en Mars etSept.");
        $action4->setExperienceTourism("Cocooning Vue sur mer");
        $action4->setSustainableMobility("Véhicule électrique Centre-ville");
        $action4->setMobilityEquipment("Borne/ Prisede rechargeTaxi ou service équivalent");
        $action4->setInvolvedActor("-OT et membres du groupe de travail BTG-hébergeurs volontaires-Renault Rent-Concessionnaire(s) local(ux)");
        $action4->setDeliverable("-Brochure des services et tarifs des hébergeurs volontaires-Liste de ou des hébergeurs retenus");
        $action4->setBudget(0);
        $action4->setTimeLimit(new \DateTime());
        $action4->setVigilancePoint("-S’assurer de l’engagement réel des hébergeurs-Impliquer les hébergeurs le plus tôt possible dans la réflexion");
        $action4->setAccomplishment(0);
        $action4->addActivities($em->merge($this->getReference('activity-j2A')));

        $action5 = new Action();
        $action5->setNumero("A5");
        $action5->setStep("Tout le séjour");
        $action5->setFeasibility(1);
        $action5->setName("Identifier des hébergeurs partenaires");
        $action5->setAssociateConstraint("");
        $action5->setPersonInCharge("OT de Saint-Malo");
        $action5->setDescription("Identifier des hébergeurs qui:-correspondent aux critères du séjour,-souhaitent s’impliquer dans le groupe de travail BTG,-ont une borne de recharge électrique (ou en projets de travaux),-un service de taxi (ou équivalent) pour chercher le couple le vendredi soir à la gare de St Malo,soit bien impliqué avec les acteurs locaux pour proposer des activités ludiques et uniques en Mars etSept.");
        $action5->setExperienceTourism("Cocooning Vue sur mer");
        $action5->setSustainableMobility("Véhicule électrique Centre-ville");
        $action5->setMobilityEquipment("Borne/ Prisede rechargeTaxi ou service équivalent");
        $action5->setInvolvedActor("-OT et membres du groupe de travail BTG-hébergeurs volontaires-Renault Rent-Concessionnaire(s) local(ux)");
        $action5->setDeliverable("-Brochure des services et tarifs des hébergeurs volontaires-Liste de ou des hébergeurs retenus");
        $action5->setBudget(0);
        $action5->setTimeLimit(new \DateTime());
        $action5->setVigilancePoint("-S’assurer de l’engagement réel des hébergeurs-Impliquer les hébergeurs le plus tôt possible dans la réflexion");
        $action5->setAccomplishment(0);
        $action5->addActivities($em->merge($this->getReference('activity-j2S')));

        $em->persist($action1);
        $em->persist($action2);
        $em->persist($action3);
        $em->persist($action4);
        $em->persist($action5);
        $em->flush();
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 3;
    }
}