<?php

namespace CV\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preference
 *
 * @ORM\Table(name="cv_preference")
 * @ORM\Entity(repositoryClass="CV\ProfileBundle\Entity\PreferenceRepository")
 */
class Preference
{

    /**
     * @ORM\OneToOne(targetEntity="CV\ProfileBundle\Entity\Profile", inversedBy="preference", cascade={"persist", "remove"})
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
     * @var boolean
     *
     * @ORM\Column(name="discussion", type="boolean", options={"default" = false})
     */
    private $discussion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="music", type="boolean", options={"default" = false})
     */
    private $music;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cigarette", type="boolean", options={"default" = false})
     */
    private $cigarette;

    /**
     * @var boolean
     *
     * @ORM\Column(name="animal", type="boolean", options={"default" = false})
     */
    private $animal;


    public function __construct()
    {
      $this->setDiscussion(false);
      $this->setMusic(false);
      $this->setCigarette(false);
      $this->setAnimal(false);
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
     * Set discussion
     *
     * @param boolean $discussion
     * @return Preference
     */
    public function setDiscussion($discussion)
    {
        $this->discussion = $discussion;

        return $this;
    }

    /**
     * Get discussion
     *
     * @return boolean 
     */
    public function getDiscussion()
    {
        return $this->discussion;
    }

    /**
     * Set music
     *
     * @param boolean $music
     * @return Preference
     */
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music
     *
     * @return boolean 
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set cigarette
     *
     * @param boolean $cigarette
     * @return Preference
     */
    public function setCigarette($cigarette)
    {
        $this->cigarette = $cigarette;

        return $this;
    }

    /**
     * Get cigarette
     *
     * @return boolean 
     */
    public function getCigarette()
    {
        return $this->cigarette;
    }

    /**
     * Set animals
     *
     * @param boolean $animals
     * @return Preference
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animals
     *
     * @return boolean 
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set profile
     *
     * @param \CV\ProfileBundle\Entity\Profile $profile
     * @return Preference
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
