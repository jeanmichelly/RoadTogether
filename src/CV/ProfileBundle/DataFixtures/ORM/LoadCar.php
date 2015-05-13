<?php

namespace CV\ProfileBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\ProfileBundle\Entity\Car;

class LoadCar extends AbstractFixture implements OrderedFixtureInterface {
  public function load(ObjectManager $manager) {
     $car = new Car();
     $car->setMark(3);
     $car->setModel(3);
     $car->setComfort(3);
     $car->setNumberPlace(3);
     $car->setColor(3);
     $car->setCategory(3);
     $car->setPicture(3);
     $car->setProfile($this->getReference('profile_Mario'));
     
     $manager->persist($car);

     $manager->flush();
 }
 
 public function getOrder() {
    return 3;
}
}