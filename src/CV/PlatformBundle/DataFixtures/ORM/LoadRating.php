<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Rating;

class LoadRating extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
    	$rating = new Rating();
     $rating->setEvaluation(4);
     $rating->setDescription('Trop cool');
     $rating->setDriving(0);
     $rating->setDate(new \DateTime('1970-1-1'));
     $rating->setState(1);
     $rating->setUser($this->getReference('mario032'));
     $rating->setRelateduser($this->getReference('jeanmly'));

     $rating2 = new Rating();
     $rating2->setEvaluation(3);
     $rating2->setDescription('Yeah');
     $rating2->setDriving(0);
     $rating2->setDate(new \DateTime('1970-1-1'));
     $rating2->setState(1);
     $rating2->setUser($this->getReference('mario032'));
     $rating2->setRelateduser($this->getReference('jeanmly'));        

     $rating3 = new Rating();
     $rating3->setEvaluation(2);
     $rating3->setDescription('toto');
     $rating3->setDriving(0);
     $rating3->setDate(new \DateTime('1970-1-1'));
     $rating3->setState(1);
     $rating3->setUser($this->getReference('mario032'));
     $rating3->setRelateduser($this->getReference('jeanmly'));

     $rating4 = new Rating();
     $rating4->setEvaluation(4);
     $rating4->setDescription('Trop cool');
     $rating4->setDriving(0);
     $rating4->setDate(new \DateTime('1970-1-1'));
     $rating4->setState(1);
     $rating4->setUser($this->getReference('mario032'));
     $rating4->setRelateduser($this->getReference('jeanmly'));

     $user = $this->getReference('jeanmly');

     $user->addRating($rating);
     $user->addRating($rating2);
     $user->addRating($rating3);
     $user->addRating($rating4);

     $manager->persist($rating);
     $manager->persist($rating2);    
     $manager->persist($rating3);    
     $manager->persist($rating4);    
     
     $manager->flush();
 }

 public function getOrder() {
    return 2;
}
}
