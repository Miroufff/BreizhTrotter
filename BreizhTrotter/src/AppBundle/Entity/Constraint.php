<?php

namespace AppBundle\Entity;

/**
 * Constraint
 */
class Constraint
{
    /**
     * @var \DateTime
     */
    private $updateDate;

    /**
     * @var integer
     */
    private $diffLevel;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $diagAction;

    /**
     * @var integer
     */
    private $viabilityImpact;

    /**
     * @var integer
     */
    private $tourismImpact;

    /**
     * @var integer
     */
    private $idImage;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Constraint
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set diffLevel
     *
     * @param integer $diffLevel
     *
     * @return Constraint
     */
    public function setDiffLevel($diffLevel)
    {
        $this->diffLevel = $diffLevel;

        return $this;
    }

    /**
     * Get diffLevel
     *
     * @return integer
     */
    public function getDiffLevel()
    {
        return $this->diffLevel;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return Constraint
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Constraint
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set diagAction
     *
     * @param string $diagAction
     *
     * @return Constraint
     */
    public function setDiagAction($diagAction)
    {
        $this->diagAction = $diagAction;

        return $this;
    }

    /**
     * Get diagAction
     *
     * @return string
     */
    public function getDiagAction()
    {
        return $this->diagAction;
    }

    /**
     * Set viabilityImpact
     *
     * @param integer $viabilityImpact
     *
     * @return Constraint
     */
    public function setViabilityImpact($viabilityImpact)
    {
        $this->viabilityImpact = $viabilityImpact;

        return $this;
    }

    /**
     * Get viabilityImpact
     *
     * @return integer
     */
    public function getViabilityImpact()
    {
        return $this->viabilityImpact;
    }

    /**
     * Set tourismImpact
     *
     * @param integer $tourismImpact
     *
     * @return Constraint
     */
    public function setTourismImpact($tourismImpact)
    {
        $this->tourismImpact = $tourismImpact;

        return $this;
    }

    /**
     * Get tourismImpact
     *
     * @return integer
     */
    public function getTourismImpact()
    {
        return $this->tourismImpact;
    }

    /**
     * Set idImage
     *
     * @param integer $idImage
     *
     * @return Constraint
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

