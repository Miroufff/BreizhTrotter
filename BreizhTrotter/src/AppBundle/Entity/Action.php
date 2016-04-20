<?php

namespace AppBundle\Entity;

/**
 * Action
 */
class Action
{
    /**
     * @var string
     */
    private $step;

    /**
     * @var \DateTime
     */
    private $updateDate;

    /**
     * @var integer
     */
    private $feasibility;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $budget;

    /**
     * @var integer
     */
    private $timeLimit;

    /**
     * @var integer
     */
    private $accomplishment;

    /**
     * @var integer
     */
    private $idImage;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set step
     *
     * @param string $step
     *
     * @return Action
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return string
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Action
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
     * Set feasibility
     *
     * @param integer $feasibility
     *
     * @return Action
     */
    public function setFeasibility($feasibility)
    {
        $this->feasibility = $feasibility;

        return $this;
    }

    /**
     * Get feasibility
     *
     * @return integer
     */
    public function getFeasibility()
    {
        return $this->feasibility;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Action
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
     * Set description
     *
     * @param string $description
     *
     * @return Action
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
     * Set budget
     *
     * @param integer $budget
     *
     * @return Action
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set timeLimit
     *
     * @param integer $timeLimit
     *
     * @return Action
     */
    public function setTimeLimit($timeLimit)
    {
        $this->timeLimit = $timeLimit;

        return $this;
    }

    /**
     * Get timeLimit
     *
     * @return integer
     */
    public function getTimeLimit()
    {
        return $this->timeLimit;
    }

    /**
     * Set accomplishment
     *
     * @param integer $accomplishment
     *
     * @return Action
     */
    public function setAccomplishment($accomplishment)
    {
        $this->accomplishment = $accomplishment;

        return $this;
    }

    /**
     * Get accomplishment
     *
     * @return integer
     */
    public function getAccomplishment()
    {
        return $this->accomplishment;
    }

    /**
     * Set idImage
     *
     * @param integer $idImage
     *
     * @return Action
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

