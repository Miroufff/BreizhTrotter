<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActionHadEquipment
 *
 * @ORM\Table(name="action_had_equipment")
 * @package AppBundle\Entity
 */
class ActionHadEquipment
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entity\Equipment")
     * @ORM\JoinColumn(name="id_equipment", referencedColumnName="id")
     */
    private $equipment;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * @param mixed $equipment
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
