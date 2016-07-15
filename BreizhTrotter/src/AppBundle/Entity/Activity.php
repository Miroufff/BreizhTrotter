<?php

namespace AppBundle\Entity;  

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activity
 *
 * @ORM\Entity
 * @ORM\Table(name="t_activity")
 * @ORM\HasLifecycleCallbacks()
 *
 * @package AppBundle\Entity
 */
class Activity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

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
     * @ORM\Column(name="feasibility", type="integer")
     */
    private $feasibility;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Scenario", inversedBy="activities")
     * @ORM\JoinColumn(name="id_scenario", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $scenario;

    /**
     * @ORM\ManyToMany(targetEntity="Action", inversedBy="activities")
     * @ORM\JoinTable(name="tr_activity_action",
     *       joinColumns={@ORM\JoinColumn(name="action_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $actions;

    /**
     * @ORM\ManyToMany(targetEntity="Constraint", inversedBy="activities")
     * @ORM\JoinTable(name="tr_activity_constraint",
     *       joinColumns={@ORM\JoinColumn(name="constraint_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $constraints;

    /**
     * @ORM\ManyToMany(targetEntity="Equipment", inversedBy="activities")
     * @ORM\JoinTable(name="tr_activity_equipment",
     *       joinColumns={@ORM\JoinColumn(name="equipment_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $equipments;

    /**
     * @ORM\ManyToMany(targetEntity="Mobility", inversedBy="activities")
     * @ORM\JoinTable(name="tr_activity_mobility",
     *       joinColumns={@ORM\JoinColumn(name="mobility_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $mobilities;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Activity constructor.
     */
    public function __construct()
    {
        $this->constraints = new ArrayCollection();
        $this->actions     = new ArrayCollection();
        $this->equipments  = new ArrayCollection();
        $this->mobilities  = new ArrayCollection();
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return Activity
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Activity
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
     * @return Activity
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
     * Set feasibility
     *
     * @param integer $feasibility
     *
     * @return Activity
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
     * @return mixed
     */
    public function getScenario()
    {
        return $this->scenario;
    }

    /**
     * @param mixed $scenario
     */
    public function setScenario($scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * Add actions
     *
     * @param Action $action
     */
    public function addActions(Action $action)
    {
        $this->actions[] = $action;
    }

    /**
     * Remove actions
     *
     * @param Action $action
     */
    public function removeActions(Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * @return mixed
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param mixed $constraints
     */
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
    }

    /**
     * Add constraints
     *
     * @param Constraint $constraint
     */
    public function addConstraints(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }

    /**
     * Remove constraints
     *
     * @param Constraint $constraint
     */
    public function removeConstraints(Constraint $constraint)
    {
        $this->constraints->removeElement($constraint);
    }

    /**
     * @return mixed
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param mixed $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
    }

    /**
     * Add equipments
     *
     * @param Equipment $equipment
     */
    public function addEquipments(Equipment $equipment)
    {
        $this->equipments[] = $equipment;
    }

    /**
     * Remove equipments
     *
     * @param Equipment $equipment
     */
    public function removeEquipments(Equipment $equipment)
    {
        $this->equipments->removeElement($equipment);
    }

    /**
     * @return mixed
     */
    public function getMobilities()
    {
        return $this->mobilities;
    }

    /**
     * @param mixed $mobilities
     */
    public function setMobilities($mobilities)
    {
        $this->mobilities = $mobilities;
    }

    /**
     * Add mobilities
     *
     * @param Mobility $mobility
     */
    public function addMobilities(Mobility $mobility)
    {
        $this->mobilities[] = $mobility;
    }

    /**
     * Remove mobilities
     *
     * @param Mobility $mobility
     */
    public function removeMobilities(Mobility $mobility)
    {
        $this->mobilities->removeElement($mobility);
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
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}

