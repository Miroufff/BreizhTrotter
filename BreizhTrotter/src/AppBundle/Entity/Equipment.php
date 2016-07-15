<?php

namespace AppBundle\Entity;  

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Entity
 * @ORM\Table(name="t_equipment")
 * @package AppBundle\Entity
 */
class Equipment
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="id_image", referencedColumnName="id")
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Activity", mappedBy="equipments")
     * @ORM\JoinTable(name="tr_activity_equipment",
     *       joinColumns={@ORM\JoinColumn(name="equipment_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $activities;

    /**
     * Equipment constructor.
     */
    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Equipment
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
        $activity->addEquipments($this);
        $this->activities[] = $activity;
    }

    /**
     * Remove activities
     *
     * @param Activity $activity
     */
    public function removeActivities(Activity $activity)
    {
        $activity->removeEquipments($this);
        $this->activities->removeElement($activity);
    }
}

