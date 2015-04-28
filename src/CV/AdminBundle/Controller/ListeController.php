<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CV\UserBundle\Entity\User;

class ListeController extends Controller
{
    public function publicMessagesAction() {
      $listPublicMessages = $this->getDoctrine()
      ->getManager()
      ->getRepository('CVPlatformBundle:PublicMessage')
      ->findAll();

      return $this->render('CVAdminBundle:Liste:public_messages.html.twig', array(
       'listPublicMessages'	=> $listPublicMessages,
       ));
  }

  public function ratingsAction() {
    $listRatings = $this->getDoctrine()
    ->getManager()
    ->getRepository('CVPlatformBundle:Rating')
    ->findAll();
    
    return $this->render('CVAdminBundle:Liste:ratings.html.twig', array(
        'listRatings'    => $listRatings,
        ));
}

public function pictureAction($thumb, User $user) {
    $em = $this->getDoctrine()->getManager();
    $profile = $em->getRepository('CVProfileBundle:Profile')
    ->requestProfileUser($user->getId());

    if (null === $profile) {
        throw new NotFoundHttpException("Le profil n'existe pas.");
    }         
    return $this->render('CVAdminBundle:Liste:picture.html.twig', array(
        'profile'   => $profile,
        'thumb'     => $thumb
        ));
}
}
