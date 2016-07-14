<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Constraint
 * 
 * @ORM\Entity
 * @ORM\Table(name="t_constraint")
 * @package AppBundle\Entity
 */
class Constraint
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetime", nullable = true)
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="diff_level", type="integer")
     */
    private $diffLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="string", length=500)
     */
    private $context;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="diag_action", type="string", length=300)
     */
    private $diagAction;

    /**
     * @var integer
     *
     * @ORM\Column(name="viability_impact", type="integer")
     */
    private $viabilityImpact;

    /**
     * @var integer
     *
     * @ORM\Column(name="tourism_impact", type="integer")
     */
    private $tourismImpact;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Activity", inversedBy="constraints")
     * @ORM\JoinColumn(name="id_activity", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $activity;

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Constraint constructor.
     */
    public function __construct()
    {
        $this->updateDate = new DateTime('NOW');;
    }

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
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}