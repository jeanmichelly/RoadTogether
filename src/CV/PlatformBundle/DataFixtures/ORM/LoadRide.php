<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Ride;

class LoadRide extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        
        $rideRoundTrip = new Ride();
        $rideRoundTrip->setUser($this->getReference('mario032'));
        $rideRoundTrip->setDeparture("Marolle sur seine");
        $rideRoundTrip->setArrival("Troyes");
        $rideRoundTrip->setDepartureDate('2015-03-02');
        $rideRoundTrip->setPrice(10);
        $rideRoundTrip->setNumberPassenger(3);
        $rideRoundTrip->setDetails("Pour le confort de tous, le dépôt s'effectuera à la gare de Troyes ou devant l'UTT");
        $rideRoundTrip->setState(0);
        $rideRoundTrip->setOfferPublished(new \DateTime('1-3-2015'));
        $this->addReference('ride_round_trip', $rideRoundTrip);
        $manager->persist($rideRoundTrip);

        $rideTripRound = new Ride();
        $rideTripRound->setUser($this->getReference('mario032'));
        $rideTripRound->setDeparture("Troyes");
        $rideTripRound->setArrival("Marolle sur seine");
        $rideTripRound->setDepartureDate('2015-03-05');
        $rideTripRound->setPrice(10);
        $rideTripRound->setNumberPassenger(3);
        $rideTripRound->setDetails("Pour le confort de tous, le dépôt s'effectuera à la gare de Marolles");
        $rideTripRound->setState(0);
        $rideTripRound->setOfferPublished(new \DateTime('1-3-2015'));
        $this->addReference('ride_trip_round', $rideTripRound);
        $manager->persist($rideTripRound);

        $rideTripRound = new Ride();
        $rideTripRound->setUser($this->getReference('mario032'));
        $rideTripRound->setDeparture("Paris");
        $rideTripRound->setArrival("Marseille");
        $rideTripRound->setDepartureDate('2015-05-01');
        $rideTripRound->setPrice(10);
        $rideTripRound->setNumberPassenger(3);
        $rideTripRound->setDetails("Pour le confort de tous, le dépôt s'effectuera à la gare de Marolles");
        $rideTripRound->setState(0);
        $rideTripRound->setOfferPublished(new \DateTime('2-4-2015'));
        $this->addReference('ride', $rideTripRound);
        $manager->persist($rideTripRound);

        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }
}