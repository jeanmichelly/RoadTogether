<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Rating;

class LoadRating extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
    	// $rating = new Rating();
     //  	$rating->setFunction(0);
     //  	$rating->setEvaluation(0);
     //  	$rating->setDescription('test avis');
     //  	$rating->setDriving(0);
     //  	$rating->setDate(new \DateTime('1970-1-1'));
     //  	$rating->setUser($this->getReference('jeanmly'));
     //  	$rating->setRelateduser($this->getReference('mario032'));

     //    $user = $this->getReference('jeanmly');
     //    $user->addRating($rating);
     //    $manager->persist($rating);    
    
     //    $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}
