<?php

namespace AppBundle\Entity;  

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Entity
 * @ORM\Table(name="t_mobility")
 * @package AppBundle\Entity
 */
class Mobility
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
     * @ORM\ManyToMany(targetEntity="Activity", mappedBy="mobilities")
     * @ORM\JoinTable(name="tr_activity_mobility",
     *       joinColumns={@ORM\JoinColumn(name="mobility_id", referencedColumnName="id")},
     *       inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")})
     */
    private $activities;

    /**
     * Mobility constructor.
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
     * Add activities
     *
     * @param Activity $activity
     */
    public function addActivities(Activity $activity)
    {
        $activity->addMobilities($this);
        $this->activities[] = $activity;
    }

    /**
     * Remove activities
     *
     * @param Activity $activity
     */
    public function removeActivities(Activity $activity)
    {
        $activity->removeMobilities($this);
        $this->activities->removeElement($activity);
    }
}

