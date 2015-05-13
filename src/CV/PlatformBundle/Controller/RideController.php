<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Entity\PrivateMessage;
use CV\PlatformBundle\Form\RideType;
use CV\PlatformBundle\Form\RideEditType;
use CV\PlatformBundle\Form\RideViewType;
use CV\PlatformBundle\Form\RideSearchType;

class RideController extends Controller
{
    public function viewAction(Ride $ride) {
        $user = $this->get('security.context')->getToken()->getUser();

        if($ride->getUser() != $user) {
            throw new NotFoundHttpException("Désolé la page est introuvable");
        }

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
            $ride->setDepartureDate(strtr($ride->getDepartureDate(), '/', '-'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($ride);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('cv_platform_upcoming_rides'));
        }

        return $this->render('CVPlatformBundle:Ride:add.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    public function editAction(Ride $ride, Request $request) {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($ride->getUser() != $user) {
            throw new NotFoundHttpException("Désolé la page est introuvable");
        }

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
        $user = $this->get('security.context')->getToken()->getUser();
        

        foreach($ride->getReservations() as $value){
            $ride->getUser()->setBalance($ride->getUser()->getBalance() - 10);
            $value->getUser()->setBalance($value->getUser()->getBalance() + 10);
            $privateMessage = new PrivateMessage($ride->getUser(), $value->getUser(), 
                "Vous avez recu un virement de 10€ de la part de ".$ride->getUser()." suite à l'annulation du voyage 
                au départ de ".$ride->getDeparture()." et à destination de ".$ride->getArrival()
                );
            $em = $this->getDoctrine()->getManager();
            $em->persist($privateMessage);
            $em->flush();
        }
        

        if ($ride->getUser() != $user) {
            throw new NotFoundHttpException("Désolé la page est introuvable");
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($ride);
        $em->flush();

        return $this->redirect($this->generateUrl('cv_platform_upcoming_rides'));
    }

    public function upcomingRidesAction($page, Request $request) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listUpcomingRides = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->upcomingRides($page, $nbPerPage, $userId);


        if (count($listUpcomingRides) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de trajets à venir');

            return $this->render('CVPlatformBundle:Ride:upcoming.html.twig', array(
                'listUpcomingRides'     => $listUpcomingRides,
                ));
        }

        $nbPages = ceil(count($listUpcomingRides)/$nbPerPage);

        return $this->render('CVPlatformBundle:Ride:upcoming.html.twig', array(
            'listUpcomingRides'     => $listUpcomingRides,
            'nbPages'       => $nbPages,
            'page'          => $page,
            ));
    }

    public function pastRidesAction($page, Request $request) {
        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listPastRides = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->pastRides($page, $nbPerPage, $userId);

        if (count($listPastRides) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de trajets passés');

            return $this->render('CVPlatformBundle:Ride:past.html.twig', array(
                'listPastRides'     => $listPastRides,
                ));
        }

        $nbPages = ceil(count($listPastRides)/$nbPerPage);

        return $this->render('CVPlatformBundle:Ride:past.html.twig', array(
            'listPastRides'     => $listPastRides,
            'nbPages'           => $nbPages,
            'page'              => $page,
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
        $ride = new Ride();
        $form = $this->createForm(new RideSearchType, $ride);

        if ($form->handleRequest($request)->isValid()) {

            $form = $form->getData();
            $departureDateToUrl = strtr($form->getDepartureDate(), '/', '-');
            $form->setDepartureDate($departureDateToUrl);

            return $this->redirect($this->generateUrl('cv_platform_focus_rides', array(
                'departure'     => $form->getDeparture(),
                'arrival'       => $form->getArrival(),
                'departureDate' => $form->getDepartureDate(),
                )));
        }
        return $this->render('CVPlatformBundle:Ride:search.html.twig', array('form' => $form->createView()));
    }

    public function focusRidesUserAction($departure, $arrival, $departureDate, $page, Request $request) {
        $nbPerPage = 5;

        $listRides = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->focusRidesUser($departure, $arrival, $departureDate, $page, $nbPerPage);

        if (count($listRides) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Il n\'existe pas de trajets correspondant à votre recherche');

            return $this->render('CVPlatformBundle:Ride:focus.html.twig', array(
                'listRides'     => $listRides,
                ));
        }

        $nbPages = ceil(count($listRides)/$nbPerPage);

        return $this->render('CVPlatformBundle:Ride:focus.html.twig', array(
          'listRides'   => $listRides,
          'nbPages'     => $nbPages,
          'page'        => $page
          ));
    }

    public function numberOfRemainingSpaceAction(Ride $ride) {
        $res = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->numberOfRemainingSpace($ride);

        return new Response($res);
    }

    public function numberOfPlacesBookedAction(Ride $ride) {
        $res = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->numberOfPlacesBooked($ride);

        return new Response(count($res));
    } 
}
