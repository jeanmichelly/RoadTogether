<?php

namespace CV\ProfileBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\ProfileBundle\Entity\Profile;

class LoadProfile extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {

        $references = array( // Par rapport aux logins utilisateurs
            'mario032',
            'jeanmly',
            'isa01',
            'mar02e',
            'sabri01',
            '59cindy'
            );

        $names = array(
            'Laporte',
            'Ly',
            'lee',
            'lit',
            'Lebois',
            'Laserrure'
            );

        $firstNames = array(
            'Mario',
            'Jean-Michel',
            'Isabelle',
            'Marie',
            'Sabrina',
            'Cindy'
            );

        for ($i=0; $i<count($references); $i++) {
            $profile = new Profile();
            $profile->setUser($this->getReference($references[$i]));
            $profile->setName($names[$i]);
            $profile->setFirstName($firstNames[$i]);
            $profile->setAge($i*2+20);
            $profile->setBiography("bio".$i);
            $profile->setPicture("picture".$i);
            $profile->setBirthday(new \DateTime('1970-1-'.$i));
            $profile->setPhone("061595031".$i);
            $profile->setLevel($i);
            $manager->persist($profile);
            $this->addReference('profile_'.$firstNames[$i], $profile);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}