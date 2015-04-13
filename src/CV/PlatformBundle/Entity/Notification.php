<?php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="cv_notification")
 * @ORM\Entity(repositoryClass="CV\PlatformBundle\Entity\NotificationRepository")
 */
class Notification
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
     * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User",inversedBy="notifications", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
    * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User", cascade={"persist"})
    * @ORM\JoinColumn(name="related_user_id", referencedColumnName="id", nullable=false)
    */
    protected $relateduser;

    /**
     * @ORM\OneToOne(targetEntity="CV\PlatformBundle\Entity\Reservation", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;

    /**
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    public function __construct($user, $relateduser, $reservation) {
        $this->user = $user;
        $this->relateduser = $relateduser;
        $this->reservation = $reservation;
        $this->state = 0;
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
     * Set user
     *
     * @param \CV\UserBundle\Entity\User $user
     * @return Notification
     */
    public function setUser(\CV\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    
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
     * Set relateduser
     *
     * @param \CV\UserBundle\Entity\User $relateduser
     * @return Notification
     */
    public function setRelateduser(\CV\UserBundle\Entity\User $relateduser)
    {
        $this->relateduser = $relateduser;
    
        return $this;
    }

    /**
     * Get relateduser
     *
     * @return \CV\UserBundle\Entity\User 
     */
    public function getRelateduser()
    {
        return $this->relateduser;
    }

    /**
     * Set reservation
     *
     * @param \CV\PlatformBundle\Entity\Reservation $reservation
     * @return Notification
     */
    public function setReservation(\CV\PlatformBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;
    
        return $this;
    }

    /**
     * Get reservation
     *
     * @return \CV\PlatformBundle\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Notification
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
