<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Payment;

class LoadPayment extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      	$paymentRounTrip = new Payment();
      
      	$paymentRounTrip->setDate(new \DateTime('1970-1-3'));
      	$paymentRounTrip->setNumberSeat(1);
      	$paymentRounTrip->setType(true);
      	$paymentRounTrip->setAmount(10);
      	$paymentRounTrip->setRide($this->getReference('ride_round_trip'));
      	$paymentRounTrip->setUser($this->getReference('jeanmly'));

        $paymentTripRound = new Payment();
        $paymentTripRound->setDate(new \DateTime('1970-1-6'));
        $paymentTripRound->setNumberSeat(1);
        $paymentTripRound->setType(false);
        $paymentTripRound->setAmount(10);
        $paymentTripRound->setRide($this->getReference('ride_trip_round'));
        $paymentTripRound->setUser($this->getReference('jeanmly'));

        $manager->persist($paymentRounTrip);
        $manager->persist($paymentTripRound);
        $manager->flush();

    }

    public function getOrder() {
        return 7;
    }
}