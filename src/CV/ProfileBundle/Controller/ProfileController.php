<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\ProfileType;

class ProfileController extends Controller
{

    public function editAction(Request $request)
  {

    $userId = $this->get('security.context')->getToken()->getUser()->getId();
        // On récupère notre objet Paginator

    $em = $this->getDoctrine()->getManager();
    $profile = $em->getRepository('CVProfileBundle:Profile')
                  ->requestProfileUser($userId)
    ;

    if (null === $profile) {
      throw new NotFoundHttpException("Le profil n'existe pas.");
    }

 $form = $this->createForm(new ProfileType, $profile);


    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Profil bien modifié');

      return $this->redirect($this->generateUrl('cv_profile_edit', array('id' => $profile->getId())));
    }
     return $this->render('CVProfileBundle::edit.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
