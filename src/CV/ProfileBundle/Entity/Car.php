<?php

namespace CV\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="cv_car")
 * @ORM\Entity(repositoryClass="CV\ProfileBundle\Entity\CarRepository")
 */
class Car
{

  /**
   * @ORM\ManyToOne(targetEntity="CV\ProfileBundle\Entity\Profile", cascade={"remove"})
   * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
   */
  private $profile;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="mark", type="smallint", nullable=true)
     */
    private $mark;

    /**
     * @var integer
     *
     * @ORM\Column(name="model", type="smallint", nullable=true)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="comfort", type="smallint", nullable=true)
     */
    private $comfort;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_place", type="smallint", nullable=true)
     */
    private $numberPlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="color", type="smallint", nullable=true)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="smallint", nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;


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
     * Set mark
     *
     * @param integer $mark
     * @return Car
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set model
     *
     * @param integer $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return integer 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set comfort
     *
     * @param integer $comfort
     * @return Car
     */
    public function setComfort($comfort)
    {
        $this->comfort = $comfort;

        return $this;
    }

    /**
     * Get comfort
     *
     * @return integer 
     */
    public function getComfort()
    {
        return $this->comfort;
    }

    /**
     * Set numberPlace
     *
     * @param integer $numberPlace
     * @return Car
     */
    public function setNumberPlace($numberPlace)
    {
        $this->numberPlace = $numberPlace;

        return $this;
    }

    /**
     * Get numberPlace
     *
     * @return integer 
     */
    public function getNumberPlace()
    {
        return $this->numberPlace;
    }

    /**
     * Set color
     *
     * @param integer $color
     * @return Car
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return integer 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Car
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Car
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set profile
     *
     * @param \CV\ProfileBundle\Entity\Profile $profile
     * @return Car
     */
    public function setProfile(\CV\ProfileBundle\Entity\Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \CV\ProfileBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
