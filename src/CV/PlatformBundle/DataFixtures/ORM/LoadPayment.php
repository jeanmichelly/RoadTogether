<?php

namespace CV\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\PlatformBundle\Entity\Payment;

class LoadPayment extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
    }

    public function getOrder() {
        return 7;
    }
}