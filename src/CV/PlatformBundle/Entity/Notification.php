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
     * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User",inversedBy="notifications", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
    * @ORM\ManyToOne(targetEntity="\CV\UserBundle\Entity\User", cascade={"persist", "remove"})
    * @ORM\JoinColumn(name="related_user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
    */
    protected $relateduser;

    public function __construct($user, $relateduser) {
        $this->user = $user;
        $this->relateduser = $relateduser;
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
}
