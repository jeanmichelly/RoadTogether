<?php

namespace CV\ProfileBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\ProfileBundle\Entity\Preference;

class LoadPreference extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      	$preference = new Preference();
        $preference->setDiscussion(true);
        $preference->setMusic(true);
        $preference->setCigarette(true);
        $preference->setAnimal(true);
        $preference->setProfile($this->getReference('profile_Mario'));
        $manager->persist($preference);
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }
}