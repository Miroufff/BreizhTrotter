<?php

namespace AppBundle\Entity;

/**
 * Equipment
 */
class Equipment
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $idImage;

    /**
     * @var integer
     */
    private $idEquipment;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Equipment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set idImage
     *
     * @param integer $idImage
     *
     * @return Equipment
     */
    public function setIdImage($idImage)
    {
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * Get idImage
     *
     * @return integer
     */
    public function getIdImage()
    {
        return $this->idImage;
    }

    /**
     * Set idEquipment
     *
     * @param integer $idEquipment
     *
     * @return Equipment
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

