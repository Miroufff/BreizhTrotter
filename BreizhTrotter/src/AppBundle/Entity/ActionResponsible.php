<?php

namespace AppBundle\Entity;

/**
 * ActionResponsible
 */
class ActionResponsible
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
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return ActionResponsible
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
     * @return ActionResponsible
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

