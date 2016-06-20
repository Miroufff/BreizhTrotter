<?php

namespace AppBundle\Entity;  

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Entity
 * @ORM\Table(name="activity")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image")
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Scenario")
     * @ORM\JoinColumn(name="id_scenario", referencedColumnName="id")
     */
    private $scenario;

    /**
     * @ORM\ManyToMany(targetEntity="Action", inversedBy="scenarios")
     * @ORM\JoinTable(name="activity_actions",
     *      joinColumns={@ORM\JoinColumn(name="id_activity", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_action", referencedColumnName="id")}
     *      )
     */
    private $actions;

    /**
     * @ORM\ManyToMany(targetEntity="Constraint", inversedBy="scenarios")
     * @ORM\JoinTable(name="activity_constraints",
     *      joinColumns={@ORM\JoinColumn(name="id_activity", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_constraint", referencedColumnName="id")}
     *      )
     */
    private $constraints;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

