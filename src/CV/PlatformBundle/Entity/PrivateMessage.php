<?php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrivateMessage
 *
 * @ORM\Table(name="cv_private_message")
 * @ORM\Entity(repositoryClass="CV\PlatformBundle\Entity\PrivateMessageRepository")
 */
class PrivateMessage
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
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

   /**
     * @ORM\ManyToOne(targetEntity="CV\UserBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;


   /**
     * @ORM\ManyToOne(targetEntity="CV\UserBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $relatedUser;

    public function __construct() {
        $this->date = new \Datetime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PrivateMessage
     */
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PrivateMessage
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
     * @return PrivateMessage
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
     * Set relatedUser
     *
     * @param \CV\UserBundle\Entity\User $user
     * @return PrivateMessage
     */
    public function setRelatedUser(\CV\UserBundle\Entity\User $relatedUser) {
        $this->relatedUser = $relatedUser;
        return $this;
    }

    /**
     * Get relatedUser
     *
     * @return \CV\UserBundle\Entity\User 
     */
    public function getRelatedUser() {
        return $this->relatedUser;
    }
}
