<?php

namespace AppBundle\Entity;

/**
 * Profit
 */
class Profit
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $idAction;

    /**
     * @var string
     */
    private $profitType;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Profit
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
     * Set idAction
     *
     * @param integer $idAction
     *
     * @return Profit
     */
    public function setIdAction($idAction)
    {
        $this->idAction = $idAction;

        return $this;
    }

    /**
     * Get idAction
     *
     * @return integer
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set profitType
     *
     * @param string $profitType
     *
     * @return Profit
     */
    public function setProfitType($profitType)
    {
        $this->profitType = $profitType;

        return $this;
    }

    /**
     * Get profitType
     *
     * @return string
     */
    public function getProfitType()
    {
        return $this->profitType;
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

