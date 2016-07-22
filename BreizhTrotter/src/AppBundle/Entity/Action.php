<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Action
 * @ORM\Entity
 * @ORM\Table(name="t_action")
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
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10)
     */
    private $numero;

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
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /** @var string
     *
     * @ORM\Column(name="associate_constraint", type="string", length=100)
     */
    private $associateConstraint;

    /**
     * @var string
     *
     * @ORM\Column(name="person_in_charge", type="string", length=250)
     */
    private $personInCharge;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="experience_tourism", type="string", length=1000)
     */
    private $experienceTourism;

    /**
     * @var string
     *
     * @ORM\Column(name="sustainable_mobility", type="string", length=1000)
     */
    private $sustainableMobility;

    /**
     * @var string
     *
     * @ORM\Column(name="involved_actor", type="string", length=1000)
     */
    private $involvedActor;

    /**
     * @var string
     *
     * @ORM\Column(name="deliverable", type="string", length=1000)
     */
    private $deliverable;

    /**
     * @var string
     *
     * @ORM\Column(name="vigilance_point", type="string", length=1000)
     */
    private $vigilancePoint;

    /**
     * @var string
     *
     * @ORM\Column(name="mobility_equipment", type="string", length=1000)
     */
    private $mobilityEquipment;

    /**
     * @var integer
     *
     * @ORM\Column(name="budget", type="integer")
     */
    private $budget;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_limit", type="datetime")
     */
    private $timeLimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="accomplishment", type="integer")
     */
    private $accomplishment;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Activity", mappedBy="actions")
     * @ORM\JoinTable(name="tr_activity_action",
     *       joinColumns={@ORM\JoinColumn(name="action_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
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
     * Action constructor.
     */
    public function __construct()
    {
        $this->updateDate = new DateTime('NOW');
        $this->timeLimit  = new DateTime();
        $this->activities = new ArrayCollection();
    }

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
     * @param \DateTime $timeLimit
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
     * @return string
     */
    public function getPersonInCharge()
    {
        return $this->personInCharge;
    }

    /**
     * @param string $personInCharge
     */
    public function setPersonInCharge($personInCharge)
    {
        $this->personInCharge = $personInCharge;
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

    /**
     * @return mixed
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param mixed $activities
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;
    }

    /**
     * Add activities
     *
     * @param Activity $activity
     */
    public function addActivities(Activity $activity)
    {
        $activity->addActions($this);
        $this->activities[] = $activity;
    }

    /**
     * Remove activities
     *
     * @param Activity $activity
     */
    public function removeActivities(Activity $activity)
    {
        $activity->removeActions($this);
        $this->activities->removeElement($activity);
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getAssociateConstraint()
    {
        return $this->associateConstraint;
    }

    /**
     * @param string $associateConstraint
     */
    public function setAssociateConstraint($associateConstraint)
    {
        $this->associateConstraint = $associateConstraint;
    }

    /**
     * @return string
     */
    public function getExperienceTourism()
    {
        return $this->experienceTourism;
    }

    /**
     * @param string $experienceTourism
     */
    public function setExperienceTourism($experienceTourism)
    {
        $this->experienceTourism = $experienceTourism;
    }

    /**
     * @return string
     */
    public function getSustainableMobility()
    {
        return $this->sustainableMobility;
    }

    /**
     * @param string $sustainableMobility
     */
    public function setSustainableMobility($sustainableMobility)
    {
        $this->sustainableMobility = $sustainableMobility;
    }

    /**
     * @return string
     */
    public function getInvolvedActor()
    {
        return $this->involvedActor;
    }

    /**
     * @param string $involvedActor
     */
    public function setInvolvedActor($involvedActor)
    {
        $this->involvedActor = $involvedActor;
    }

    /**
     * @return mixed
     */
    public function getDeliverable()
    {
        return $this->deliverable;
    }

    /**
     * @param mixed $deliverable
     */
    public function setDeliverable($deliverable)
    {
        $this->deliverable = $deliverable;
    }

    /**
     * @return mixed
     */
    public function getVigilancePoint()
    {
        return $this->vigilancePoint;
    }

    /**
     * @param mixed $vigilancePoint
     */
    public function setVigilancePoint($vigilancePoint)
    {
        $this->vigilancePoint = $vigilancePoint;
    }

    /**
     * @return string
     */
    public function getMobilityEquipment()
    {
        return $this->mobilityEquipment;
    }

    /**
     * @param string $mobilityEquipment
     */
    public function setMobilityEquipment($mobilityEquipment)
    {
        $this->mobilityEquipment = $mobilityEquipment;
    }
}
