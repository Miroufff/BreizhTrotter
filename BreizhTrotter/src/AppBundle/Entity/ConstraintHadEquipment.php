<?php

namespace AppBundle\Entity;

/**
 * ConstraintHadEquipment
 */
class ConstraintHadEquipment
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
     * @return ConstraintHadEquipment
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

