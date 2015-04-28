<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\PreferenceType;

class PreferenceController extends Controller
{

  public function editAction(Request $request)
  {
    $user = $this->get('security.context')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    $profileUser = $em->getRepository('CVProfileBundle:Profile')->findOneBy(array('user' => $user));
    $preference = $em->getRepository('CVProfileBundle:Preference')
    ->requestPreferenceUser($profileUser->getId());

    if (null === $preference) {
      throw new NotFoundHttpException("Les preférences n'existe pas.");
    }

    $form = $this->createForm(new PreferenceType, $preference);

    if ($form->handleRequest($request)->isValid()) {

      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Preference bien modifié');

      return $this->redirect($this->generateUrl('cv_profile_edit_preference'));
    }
    return $this->render('CVProfileBundle:Preference:edit.html.twig', array(
      'form' => $form->createView(),
      ));
  }
}