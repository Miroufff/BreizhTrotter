<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Action
 * @ORM\Entity
 * @ORM\Table(name="action")
 * @package AppBundle\Entity
 */
class Action
{
    /**
     * @var string
     *
     * @ORM\Column(name="step", type="string", length=50)
     */
    private $step;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetime", nullable = true)
     */
    private $updateDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="feasibility", type="integer")
     */
    private $feasibility;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="budget", type="integer")
     */
    private $budget;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_limit", type="integer")
     */
    private $timeLimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="accomplishment", type="integer")
     */
    private $accomplishment;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image")
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Activity", inversedBy="actions")
     *
     */
    private $activities;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
