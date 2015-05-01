<?php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="cv_rating")
 * @ORM\Entity(repositoryClass="CV\PlatformBundle\Entity\RatingRepository")
 */
class Rating
{
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
     * @ORM\Column(name="evaluation", type="smallint", nullable=true)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="driving", type="smallint", nullable=true)
     */
    private $driving;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User",inversedBy="ratings", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
    * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User", cascade={"persist", "remove"})
    * @ORM\JoinColumn(name="related_user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
    */
    protected $relateduser;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set evaluation
     *
     * @param integer $evaluation
     * @return Rating
     */
    public function setEvaluation($evaluation) {
        $this->evaluation = $evaluation;
        return $this;
    }

    /**
     * Get evaluation
     *
     * @return integer 
     */
    public function getEvaluation() {
        return $this->evaluation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Rating
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set driving
     *
     * @param integer $driving
     * @return Rating
     */
    public function setDriving($driving) {
        $this->driving = $driving;
        return $this;
    }

    /**
     * Get driving
     *
     * @return integer 
     */
    public function getDriving() {
        return $this->driving;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Rating
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \CV\UserBundle\Entity\User $user
     * @return Rating
     */
    public function setUser(\CV\UserBundle\Entity\User $user) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \CV\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set relateduser
     *
     * @param \CV\UserBundle\Entity\User $relateduser
     * @return Rating
     */
    public function setRelateduser(\CV\UserBundle\Entity\User $relateduser) {
        $this->relateduser = $relateduser;
        return $this;
    }

    /**
     * Get relateduser
     *
     * @return \CV\UserBundle\Entity\User 
     */
    public function getRelateduser() {
        return $this->relateduser;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Rating
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }
}
