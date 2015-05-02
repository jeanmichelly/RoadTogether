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

        $reservationRoundTrip = new Reservation($ride, $user, 1);
        $ride->addReservation($reservationRoundTrip);
        $manager->persist($ride);

        $ride = $this->getReference('ride_trip_round');
        $user = $this->getReference('jeanmly');

        $reservationTripRound = new Reservation($ride, $user, 2);
        $ride->addReservation($reservationTripRound);

        $user = $this->getReference('isa01');

        $reservationTripRound = new Reservation($ride, $user, 1);
        $ride->addReservation($reservationTripRound);

        $manager->persist($ride);

        $ride = $this->getReference('ride');

        $user = $this->getReference('jeanmly');
        $reservation = new Reservation($ride, $user, 1);
        $ride->addReservation($reservation);

        $user2 = $this->getReference('isa01');
        $reservation2 = new Reservation($ride, $user2, 1);
        $ride->addReservation($reservation2);

        $manager->persist($ride);
        
        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }
}