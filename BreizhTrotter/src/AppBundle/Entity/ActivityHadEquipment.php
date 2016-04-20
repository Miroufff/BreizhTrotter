<?php

namespace AppBundle\Entity;

/**
 * ActivityHadEquipment
 */
class ActivityHadEquipment
{
    /**
     * @var integer
     */
    private $idEquipment;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set idEquipment
     *
     * @param integer $idEquipment
     *
     * @return ActivityHadEquipment
     */
    public function setIdEquipment($idEquipment)
    {
        $this->idEquipment = $idEquipment;

        return $this;
    }

    /**
     * Get idEquipment
     *
     * @return integer
     */
    public function getIdEquipment()
    {
        return $this->idEquipment;
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

