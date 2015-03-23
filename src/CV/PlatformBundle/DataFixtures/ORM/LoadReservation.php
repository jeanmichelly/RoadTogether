<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Reservation;

class LoadReservation extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
     	  
        $ride = $this->getReference('ride_round_trip');
        $user = $this->getReference('jeanmly');

        $reservationRoundTrip = new Reservation($ride, $user);
        $manager->persist($reservationRoundTrip);

        $ride = $this->getReference('ride_trip_round');
        $user = $this->getReference('jeanmly');

        $reservationTripRound = new Reservation($ride, $user);
        $manager->persist($reservationTripRound);
        
        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }
}