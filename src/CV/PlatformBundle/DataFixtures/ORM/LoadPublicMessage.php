<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\PublicMessage;

class LoadPublicMessage extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      	$publicMessageRoundTripPassenger = new PublicMessage();
      	$publicMessageRoundTripPassenger->setQuestion("Pouvez vous venir me chercher à la gare de Marolles ? Cordialement");
      	$publicMessageRoundTripPassenger->setDate(new \DateTime('1970-1-1'));
      	$publicMessageRoundTripPassenger->setRide($this->getReference('ride_round_trip'));
      	$publicMessageRoundTripPassenger->setUser($this->getReference('jeanmly'));
        $manager->persist($publicMessageRoundTripPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setQuestion("Oui bien sur");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-1'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('mario032'));
        $manager->persist($publicMessageTripRoundPassenger);

        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }
}