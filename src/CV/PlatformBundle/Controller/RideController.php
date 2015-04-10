<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Form\RideType;
use CV\PlatformBundle\Form\RideEditType;
use CV\PlatformBundle\Form\RideViewType;

class RideController extends Controller
{
    public function viewAction(Ride $ride) {

        $form = $this->createForm(new RideViewType, $ride,array(
            'read_only' => true
        ));

        return $this->render('CVPlatformBundle:Ride:my_ride_details.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function addAction(Request $request) {
        $ride = new Ride();
        $ride->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm(new RideType, $ride);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ride);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('cv_platform_view', array('id' => $ride->getId())));
        }

        return $this->render('CVPlatformBundle:Ride:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Ride $ride, Request $request) {

        $form = $this->createForm(new RideEditType, $ride);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirect($this->generateUrl('cv_platform_view', array('id' => $ride->getId())));
        }

        return $this->render('CVPlatformBundle:Ride:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction(Ride $ride, Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($ride);
        $em->flush();

        return $this->redirect($this->generateUrl('cv_platform_my_rides'));
    }

    public function upcomingRidesAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listUpcomingRides = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->upcomingRides($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listUpcomingRides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Ride:upcoming.html.twig', array(
            'listUpcomingRides'     => $listUpcomingRides,
            'nbPages'       => $nbPages,
            'page'          => $page,
        ));
    }

    public function pastRidesAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listPastRides = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->pastRides($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listPastRides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Ride:past.html.twig', array(
            'listPastRides'     => $listPastRides,
            'nbPages'       => $nbPages,
            'page'          => $page,
        ));
    }

    public function myRidesAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRides = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->myRides($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listRides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Ride:my_rides.html.twig', array(
            'listRides'     => $listRides,
            'nbPages'       => $nbPages,
            'page'          => $page,
        ));
    }

    public function searchRidesUserAction(Request $request) {
        $form = $this->get('form.factory')->createBuilder('form')
            ->add('departure',          'text',     array('data' => 'Paris'))
            ->add('arrival',            'text',     array('data' => 'Marseille'))
            ->add('departure_date',     'text',     array('data' => '2015/05/01'))
            ->add('rechercher',         'submit')
            ->getForm();


        if ($form->handleRequest($request)->isValid()) {
            $departureDateToUrl = strtr($form->get('departure_date')->getData(), '/', '-');
            return $this->redirect($this->generateUrl('cv_platform_focus_rides', 
                array(
                    'departure' => $form->get('departure')->getData(),
                    'arrival' => $form->get('arrival')->getData(),
                    'departure_date' => $departureDateToUrl,
                )));
        }

        return $this->render('CVPlatformBundle:Ride:search.html.twig', array('form' => $form->createView()));
    }

    public function focusRidesUserAction($departure, $arrival, $departure_date, $page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $listRides = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->focusRidesUser($departure, $arrival, $departure_date, $page, $nbPerPage)
        ;

        $nbPages = ceil(count($listRides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Ride:focus.html.twig', array(
              'listRides'   => $listRides,
              'nbPages'     => $nbPages,
              'page'        => $page
        ));
    }
}
