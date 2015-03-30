<?php
// src/CV/PlatformBundle/Entity/Payment.php

namespace CV\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cv_payment")
 * @ORM\Entity(repositoryClass="CV\PlatformBundle\Entity\PaymentRepository")
 */
class Payment
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="payment_date", type="datetime")
   */
  private $date;

  /**
   * @ORM\Column(name="number_seat", type="smallint")
   */
  private $numberSeat;

  /**
   * @ORM\Column(name="type", type="boolean")
   */
  private $type;

  /**
   * @ORM\Column(name="amount", type="smallint")
   */
  private $amount;

  /**
   * @ORM\ManyToOne(targetEntity="CV\PlatformBundle\Entity\Ride", cascade={"persist", "remove"})
   * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
   */
  private $ride;

  /**
   * @ORM\ManyToOne(targetEntity="CV\UserBundle\Entity\User", cascade={"persist", "remove"})
   * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
   */
  private $user;
  

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Payment
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
     * Set numberSeat
     *
     * @param integer $numberSeat
     * @return Payment
     */
    public function setNumberSeat($numberSeat) {
        $this->numberSeat = $numberSeat;
        return $this;
    }

    /**
     * Get numberSeat
     *
     * @return integer 
     */
    public function getNumberSeat() {
        return $this->numberSeat;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Payment
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Payment
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set ride
     *
     * @param \CV\PlatformBundle\Entity\Ride $ride
     * @return Payment
     */
    public function setRide(\CV\PlatformBundle\Entity\Ride $ride) {
        $this->ride = $ride;
        return $this;
    }

    /**
     * Get ride
     *
     * @return \CV\PlatformBundle\Entity\Ride 
     */
    public function getRide() {
        return $this->ride;
    }

    /**
     * Set user
     *
     * @param \CV\UserBundle\Entity\User $user
     * @return Payment
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
}
