<?php

namespace CV\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="cv_user")
 * @ORM\Entity(repositoryClass="CV\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_registration", type="date")
     */
    private $dateRegistration;

    /**
     * @var smallint
     *
     * @ORM\Column(name="balance", type="smallint")
     */
    private $balance;

    /**
    * @ORM\OneToMany(targetEntity="\CV\PlatformBundle\Entity\Rating", mappedBy="user", cascade={"persist", "remove"})
    */
    private $ratings; 

    /**
    * @ORM\OneToOne(targetEntity="CV\ProfileBundle\Entity\Profile", mappedBy="user", cascade={"persist", "remove"})
    * @Assert\Valid()
    */
    private $profile;

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
     * Set balance
     *
     * @param integer $balance
     * @return User
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer 
     */
    public function getBalance()
    {
        return $this->balance;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->balance = 100;
        $this->setDateRegistration(new \Datetime());
    }

    /**
     * Add ratings
     *
     * @param \CV\PlatformBundle\Entity\Rating $ratings
     * @return User
     */
    public function addRating(\CV\PlatformBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;

        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \CV\PlatformBundle\Entity\Rating $ratings
     */
    public function removeRating(\CV\PlatformBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Set dateRegistration
     *
     * @param \DateTime $dateRegistration
     * @return User
     */
    public function setDateRegistration($dateRegistration)
    {
        $this->dateRegistration = $dateRegistration;

        return $this;
    }

    /**
     * Get dateRegistration
     *
     * @return \DateTime 
     */
    public function getDateRegistration()
    {
        return $this->dateRegistration;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set profile
     *
     * @param \CV\ProfileBundle\Entity\Profile $profile
     * @return User
     */
    public function setProfile(\CV\ProfileBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
        $profile->setUser($this);

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
