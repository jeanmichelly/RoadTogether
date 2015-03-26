<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\PublicMessage;

class LoadPublicMessage extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      	$publicMessageRoundTripPassenger = new PublicMessage();
      	$publicMessageRoundTripPassenger->setContent("Pouvez vous venir me chercher à la gare de Marolles ? Cordialement");
      	$publicMessageRoundTripPassenger->setDate(new \DateTime('1970-1-1'));
      	$publicMessageRoundTripPassenger->setRide($this->getReference('ride_round_trip'));
      	$publicMessageRoundTripPassenger->setUser($this->getReference('jeanmly'));
        $manager->persist($publicMessageRoundTripPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Oui bien sur");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-1'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('mario032'));
        $manager->persist($publicMessageTripRoundPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Avez vous la place pour une valise 90x40cm ? ");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-3'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('jeanmly'));
        $manager->persist($publicMessageTripRoundPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Est ce que je peux ramener mon bouldogue ? ");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-4'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('jeanmly'));
        $manager->persist($publicMessageTripRoundPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Heu, faut peut être pas abusé là :/");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-5'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('mario032'));
        $manager->persist($publicMessageTripRoundPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Bonjour, pouvez vous venir me chercher devant l'UTT ?");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-6'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('isa01'));
        $manager->persist($publicMessageTripRoundPassenger);

        $publicMessageTripRoundPassenger = new PublicMessage();
        $publicMessageTripRoundPassenger->setContent("Non j'ai pas envie");
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-7'));
        $publicMessageTripRoundPassenger->setRide($this->getReference('ride_round_trip'));
        $publicMessageTripRoundPassenger->setUser($this->getReference('mario032'));
        $manager->persist($publicMessageTripRoundPassenger);

        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }
}