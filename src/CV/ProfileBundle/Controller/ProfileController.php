<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\ProfileType;
use CV\ProfileBundle\Form\CarType;
use CV\ProfileBundle\Form\CarsType;
use CV\ProfileBundle\Form\PreferenceType;
use CV\ProfileBundle\Entity\Profile;

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

      $request->getSession()->getFlashBag()->add('notice', 'Profil bien modifié.');

      return $this->redirect($this->generateUrl('cv_profile_edit', array('id' => $profile->getId())));
    }
     return $this->render('CVProfileBundle:Profile:edit.html.twig', array(
      'form' => $form->createView(),
    ));
  }

      public function editCarAction($id, Request $request)
  {

    $userId = $this->get('security.context')->getToken()->getUser()->getId();
        // On récupère notre objet Paginator

    $em = $this->getDoctrine()->getManager();
     //$profile = $em->getRepository('CVProfileBundle:Profile')->find($id);
    $cars = $em->getRepository('CVProfileBundle:Car')
                  ->requestCarUser($id)
    ;

        //$cars = $em->getRepository('CVProfileBundle:Car')->find($id);

    //$cars = $em->getRepository('CVProfileBundle:Car')->find(2);

    if (null === $cars) {
      throw new NotFoundHttpException("Le profil n'existe pas.");
    }
    

 $form = $this->createForm(new CarsType, $cars);


    if ($form->handleRequest($request)->isValid()) {

         
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Profil bien modifié.');

              // On donne toutes les informations nécessaires à la vue
    return $this->render('CVProfileBundle:Profile:edit_car.html.twig', array(
      'cars' => $cars,
            'form' => $form->createView(),
    ));
    }
     return $this->render('CVProfileBundle:Profile:edit_car.html.twig', array(
      'cars' => $cars,
      'form' => $form->createView(),
    ));
  }

    public function editPreferenceAction($id, Request $request)
  {

    $em = $this->getDoctrine()->getManager();
    $preference = $em->getRepository('CVProfileBundle:Preference')
                  ->requestPreferenceUser($id)
    ;

    if (null === $preference) {
      throw new NotFoundHttpException("Les preférences n'existe pas.");
    }

 $form = $this->createForm(new PreferenceType, $preference);


    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Preference bien modifié.');

      return $this->redirect($this->generateUrl('cv_profile_edit_preference', array('id' => $id)));
    }
     return $this->render('CVProfileBundle:Profile:edit_preference.html.twig', array(
      'form' => $form->createView(),
    ));
  }

}
