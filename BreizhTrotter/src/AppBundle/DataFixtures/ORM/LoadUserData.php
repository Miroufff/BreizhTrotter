<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 21/07/2016
 * Time: 15:21
 */

namespace AppBundle\DataFixtures;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $admin = new User();
        $admin->setUsername("admin");
        $admin->setEmail("admin");
        $admin->setPlainPassword("admin");
        $admin->setEnabled(true);
        $admin->addRole("ROLE_SUPER_ADMIN");
        $admin->addRole("ROLE_SCENARIO_VALIDATION");
        $admin->addRole("ROLE_SCENARIO_LIST");
        $admin->addRole("ROLE_SCENARIO_UPDATE");
        $admin->addRole("ROLE_SCENARIO_DELETE");
        $admin->addRole("ROLE_EQUIPMENT");
        $admin->addRole("ROLE_MOBILITY");

        $em->persist($admin);
        $em->flush();
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 7;
    }
}