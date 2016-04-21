<?php

namespace AppBundle\Entity;  

use Doctrine\ORM\Mapping as ORM;

/**
 * Profit
 *
 * @ORM\Table(name="profit")
 * @package AppBundle\Entity
 */
class Profit
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entity\Action")
     * @ORM\JoinColumn(name="id_action", referencedColumnName="id")
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="profit_type", type="string", length=50)
     */
    private $profitType;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
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

