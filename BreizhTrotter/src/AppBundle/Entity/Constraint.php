<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constraint
 * 
 * @ORM\Entity
 * @ORM\Table(name="constraint")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image")
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Scenario", inversedBy="constraints")
     */
    private $scenarios;

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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

