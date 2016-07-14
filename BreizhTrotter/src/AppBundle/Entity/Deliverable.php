<?php

namespace AppBundle\Entity;  

use Doctrine\ORM\Mapping as ORM;

/**
 * Deliverable
 *
 * @ORM\Entity
 * @ORM\Table(name="t_deliverable")
 * @package AppBundle\Entity
 */
class Deliverable
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Action")
     * @ORM\JoinColumn(name="id_action", referencedColumnName="id")
     */
    private $action;

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
     * @return Deliverable
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

