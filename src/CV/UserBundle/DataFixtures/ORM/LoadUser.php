<?php
namespace CV\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CV\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadUser extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * {@inheritDoc}
   */
  public function setContainer(ContainerInterface $container = null) 
  {
    $this->container = $container;
  }


  public function load(ObjectManager $manager)
  {
    $references = array(
      'mario032',
      'jeanmly',
      'isa01',
      'mar02e',
      'totito',
      'sabri01',
      '59cindy'
      );

    $userManager = $this->container->get('fos_user.user_manager');

    foreach ($references as $ref) {
      $user = $userManager->createUser();
      $user->setUsername($ref);
      $user->setEmail($ref.'@gmail.com');
      $user->setPlainPassword($ref);
      $user->setEnabled(true);
      $user->setBalance(100);
      $user->setDateRegistration(new \DateTime());

      if($user->getUserName() == 'mario032'){
        $user->setRoles(array('ROLE_ADMIN'));
      }
      
     $manager->persist($user);
     $this->addReference($ref, $user);
   }

   $manager->flush();
 }

 public function getOrder() {
  return 1;
}
}