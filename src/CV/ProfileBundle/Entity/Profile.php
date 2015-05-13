<?php

namespace CV\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Profile
 *
 * @ORM\Table(name="cv_profile")
 * @ORM\Entity(repositoryClass="CV\ProfileBundle\Entity\ProfileRepository")
 */
class Profile
{

    /**
     * @ORM\OneToOne(targetEntity="CV\UserBundle\Entity\User", inversedBy="profile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Le nom doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Le nom doit avoir au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9 ]+$/",
     *     match=true,
     *     message="Les caractères spéciaux sont interdits"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom ne peut pas contenir de nombre"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=20, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Le prénom doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Le prénom doit avoir au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9 ]+$/",
     *     match=true,
     *     message="Les caractères spéciaux sont interdits"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le prénom ne peut pas contenir de nombre"
     * )
     */
    private $firstName;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 10,
     *      max = 100,
     *      minMessage = "L'âge doit être au minimum de {{ limit }}",
     *      maxMessage = "L'âge doit être au maximum de {{ limit }}"
     * )
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     * @Assert\Regex("/^\w+/")
     */
    private $biography;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
    * @Assert\Length(
     *      min = 10,
     *      max = 20,
     *      minMessage = "Le numéro de téléphone doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Le numéro de téléphone doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="smallint", nullable=true)
     */
    private $level;

    /**
    * @ORM\OneToOne(targetEntity="CV\PlatformBundle\Entity\Image", cascade={"persist"})
    * @Assert\Valid
    */
    private $image;

    /**
    * @ORM\OneToOne(targetEntity="CV\ProfileBundle\Entity\Preference", mappedBy="profile", cascade={"persist"})
    */
    private $preference;

    /**
    * @ORM\OneToMany(targetEntity="CV\ProfileBundle\Entity\Car", mappedBy="profile", cascade={"persist"})
    */
    private $car;

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
     * Set name
     *
     * @param string $name
     * @return Profile
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
     * Set firstName
     *
     * @param string $firstName
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Profile
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return Profile
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Profile
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
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Profile
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Profile
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Profile
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set user
     *
     * @param \CV\UserBundle\Entity\User $user
     * @return Profile
     */
    public function setUser(\CV\UserBundle\Entity\User $user)
    {
        $this->user = $user;
        //$user->setProfile($this);

        return $this;
    }

    /**
     * Get user
     *
     * @return \CV\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set image
     *
     * @param \CV\PlatformBundle\Entity\Image $image
     * @return Profile
     */
    public function setImage(\CV\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \CV\PlatformBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set preference
     *
     * @param \CV\ProfileBundle\Entity\Preference $preference
     * @return Profile
     */
    public function setPreference(\CV\ProfileBundle\Entity\Preference $preference = null)
    {
        $this->preference = $preference;

        return $this;
    }

    /**
     * Get preference
     *
     * @return \CV\ProfileBundle\Entity\Preference 
     */
    public function getPreference()
    {
        return $this->preference;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->car = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add car
     *
     * @param \CV\ProfileBundle\Entity\Car $car
     * @return Profile
     */
    public function addCar(\CV\ProfileBundle\Entity\Car $car)
    {
        $this->car[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \CV\ProfileBundle\Entity\Car $car
     */
    public function removeCar(\CV\ProfileBundle\Entity\Car $car)
    {
        $this->car->removeElement($car);
    }

    /**
     * Get car
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCar()
    {
        return $this->car;
    }
}
