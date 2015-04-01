<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\CarType;
use CV\ProfileBundle\Form\CarViewType;
use CV\ProfileBundle\Form\CarEditType;
use CV\ProfileBundle\Entity\Car;

class CarController extends Controller
{

      public function addAction(Request $request)
  {

    $user = $this->get('security.context')->getToken()->getUser();


    $em = $this->getDoctrine()->getManager();
    $profileUser = $em->getRepository('CVProfileBundle:Profile')->findOneBy(array('user' => $user));



    $car = new Car();
    $car->setProfile($profileUser);

    $form = $this->createForm(new CarType, $car);


    if ($form->handleRequest($request)->isValid()) {

      $em->persist($car);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Voiture bien ajouté');

    return $this->redirect($this->generateUrl('cv_profile_view_car', array('id' => $car->getId())));
    }
     return $this->render('CVProfileBundle:Car:add.html.twig', array(
      'form' => $form->createView(),
    ));


  }

    public function editAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('CVProfileBundle:Car')->find($id);

        if (null === $car) {
            throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(new CarEditType, $car);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Voiture bien modifiée');

            return $this->redirect($this->generateUrl('cv_profile_view_car', array('id' => $car->getId())));
        }

        return $this->render('CVProfileBundle:Car:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('CVProfileBundle:Car')->find($id);

        if (null === $car) {
            throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
        }


 // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($car);
      $em->flush();

     $request->getSession()->getFlashBag()->add('notice', 'La voiture a bien été supprimée');


      return $this->redirect($this->generateUrl('cv_profile_my_cars'));
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('CVProfileBundle:Car:delete.html.twig', array(
      'car' => $car,
      'form'   => $form->createView()
    ));
    }


      public function viewAction($id) {
        $car = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVProfileBundle:Car')
            ->find($id);

        $form = $this->createForm(new CarViewType, $car,array(
            'read_only' => true
        ));

        return $this->render('CVProfileBundle:Car:my_car_details.html.twig', array(
            'form' => $form->createView(),
        ));
    }


      public function myCarsAction($page) {

        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $profileUser = $em->getRepository('CVProfileBundle:Profile')->findOneBy(array('user' => $user));
        
        $cars = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVProfileBundle:Car')
            ->requestCarUser($page, $nbPerPage, $profileUser->getId());

        $nbPages = ceil(count($cars)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVProfileBundle:Car:my_cars.html.twig', array(
            'cars'     => $cars,
            'nbPages'       => $nbPages,
            'page'          => $page,
        ));
    }
}
