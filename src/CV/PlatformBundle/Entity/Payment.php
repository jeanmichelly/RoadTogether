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
   * @ORM\Column(name="payment_date", type="datetime", nullable=true)
   */
  private $date;

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
   * @ORM\Column(name="state", type="smallint")
   */
  private $state;
  

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
     * Set state
     *
     * @param integer $state
     * @return Payment
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
