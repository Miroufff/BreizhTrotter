<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:24
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Constraint;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadConstraintData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $constraint1 = new Constraint();
        $constraint1->setNumero("C1");
        $constraint1->setStep("Tout le séjour");
        $constraint1->setDiffLevel(1);
        $constraint1->setName("Pas d’hébergeur identifié");
        $constraint1->setAssociateAction("A1 / A2 / A3");
        $constraint1->setContext("Le groupe de travail BTG a déjà co");
        $constraint1->setDescription("Identifier des hébergeurs à Dinard correspondants aux critères de la cible (tarifs, expérience de tourisme, services...), ayant une borne de recharge électrique ou souhaitant très prochainement faire des travaux, et souhaitant s’impliquer dans le groupe de travail.L’hébergeur doit également proposer pour le vendredi soir un service (de taxi?) pour récupérer les clients à la gare SNCF de St Malo.");
        $constraint1->setMobilityEquipment("Borne de recharge électrique");
        $constraint1->setPersonInCharge("OT, Ville de Dinard, hébergeurs volontaires");
        $constraint1->setDiagAction("Possibilitéde besoin de diagnostic pour réaliser des travaux d’implantation d’une borne de recharge");
        $constraint1->setViabilityImpact(2);
        $constraint1->setTourismImpact(2);
        $constraint1->addActivities($em->merge($this->getReference('activity-j1')));
        $constraint1->addActivities($em->merge($this->getReference('activity-j2M')));

        $constraint2 = new Constraint();
        $constraint2->setNumero("C2");
        $constraint2->setStep("Tout le séjour");
        $constraint2->setDiffLevel(1);
        $constraint2->setName("Pas d’hébergeur identifié");
        $constraint2->setAssociateAction("A1 / A4");
        $constraint2->setContext("Le groupe de travail BTG a déjà co");
        $constraint2->setDescription("Identifier des hébergeurs à Dinard correspondants aux critères de la cible (tarifs, expérience de tourisme, services...), ayant une borne de recharge électrique ou souhaitant très prochainement faire des travaux, et souhaitant s’impliquer dans le groupe de travail.L’hébergeur doit également proposer pour le vendredi soir un service (de taxi?) pour récupérer les clients à la gare SNCF de St Malo.");
        $constraint2->setMobilityEquipment("Borne de recharge électrique");
        $constraint2->setPersonInCharge("OT, Ville de Dinard, hébergeurs volontaires");
        $constraint2->setDiagAction("Possibilitéde besoin de diagnostic pour réaliser des travaux d’implantation d’une borne de recharge");
        $constraint2->setViabilityImpact(2);
        $constraint2->setTourismImpact(2);
        $constraint2->addActivities($em->merge($this->getReference('activity-j2S')));

        $em->persist($constraint1);
        $em->persist($constraint2);
        $em->flush();
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 4;
    }
}