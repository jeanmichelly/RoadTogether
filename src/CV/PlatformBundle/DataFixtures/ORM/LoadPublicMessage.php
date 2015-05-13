<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\PublicMessage;

class LoadPublicMessage extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
        $publicMessageRoundTripPassenger = new PublicMessage(
            "Pouvez vous venir me chercher à la gare de Marolles ? Cordialement", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('jeanmly')
            );
        $publicMessageRoundTripPassenger->setDate(new \DateTime('1970-1-1'));
        $manager->persist($publicMessageRoundTripPassenger);


        $publicMessageTripRoundPassenger = new PublicMessage(
            "Oui bien sur", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('mario032')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-1'));
        $manager->persist($publicMessageTripRoundPassenger);


        $publicMessageTripRoundPassenger = new PublicMessage(
            "Avez vous la place pour une valise 90x40cm ? ", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('jeanmly')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-3'));
        $manager->persist($publicMessageTripRoundPassenger);


        $publicMessageTripRoundPassenger = new PublicMessage(
            "Est ce que je peux ramener mon bouldogue ? ", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('jeanmly')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-4'));
        $manager->persist($publicMessageTripRoundPassenger);


        $publicMessageTripRoundPassenger = new PublicMessage(
            "Heu, faut peut être pas abusé là :/", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('mario032')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-5'));
        $manager->persist($publicMessageTripRoundPassenger);


        $publicMessageTripRoundPassenger = new PublicMessage(
            "Bonjour, pouvez vous venir me chercher devant l'UTT ?", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('isa01')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-6'));
        $manager->persist($publicMessageTripRoundPassenger);

        
        $publicMessageTripRoundPassenger = new PublicMessage(
            "Non j'ai pas envie", 
            $this->getReference('ride_round_trip'), 
            $this->getReference('mario032')
            );
        $publicMessageTripRoundPassenger->setDate(new \DateTime('1970-1-7'));
        $manager->persist($publicMessageTripRoundPassenger);
        

        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }
}