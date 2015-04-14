<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Rating;

class LoadRating extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
    	$rating = new Rating();
      	$rating->setFunction(0);
      	$rating->setEvaluation(0);
      	$rating->setDescription('Trop cool');
      	$rating->setDriving(0);
      	$rating->setDate(new \DateTime('1970-1-1'));
      	$rating->setUser($this->getReference('mario032'));
      	$rating->setRelateduser($this->getReference('jeanmly'));

        $rating2 = new Rating();
        $rating2->setFunction(0);
        $rating2->setEvaluation(0);
        $rating2->setDescription('Yeah');
        $rating2->setDriving(0);
        $rating2->setDate(new \DateTime('1970-1-1'));
        $rating2->setUser($this->getReference('mario032'));
        $rating2->setRelateduser($this->getReference('jeanmly'));        

        $rating3 = new Rating();
        $rating3->setFunction(0);
        $rating3->setEvaluation(0);
        $rating3->setDescription('toto');
        $rating3->setDriving(0);
        $rating3->setDate(new \DateTime('1970-1-1'));
        $rating3->setUser($this->getReference('mario032'));
        $rating3->setRelateduser($this->getReference('jeanmly'));

        $user = $this->getReference('jeanmly');

        $user->addRating($rating);
        $user->addRating($rating2);
        $user->addRating($rating3);

        $manager->persist($rating);
        $manager->persist($rating2);    
        $manager->persist($rating3);    
    
        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}
