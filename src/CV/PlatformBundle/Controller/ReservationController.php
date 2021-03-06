<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Reservation;

class ReservationController extends Controller
{
    public function viewAction(Ride $ride) {

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listPublicMessagesOfRide = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:PublicMessage')
        ->publicMessagesOfRide($ride);

        $numberOfPlacesBooked = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Ride')
        ->numberOfPlacesBooked($ride);

        return $this->render('CVPlatformBundle:Reservation:view.html.twig', array(
            'ride'                        => $ride,
            'listPublicMessagesOfRide'    => $listPublicMessagesOfRide,
            'numberOfPlacesBooked'        => $numberOfPlacesBooked,
        ));
    }
    
    public function confirmAction(Ride $ride, Request $request) {

        $reservation = new Reservation($ride, $this->get('security.context')->getToken()->getUser(), $this->container->get('request')->get('valeur'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();            

        return $this->redirect($this->generateUrl('cv_platform_current_reservations'));
    }

    public function currentReservationsAction($page, Request $request) {
        $nbPerPage = 5;
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listCurrentReservations = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Reservation')
        ->currentReservations($page, $nbPerPage, $userId);

        if (count($listCurrentReservations) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore réservations en cours');

            return $this->render('CVPlatformBundle:Reservation:current.html.twig', array(
                'listCurrentReservations'     => $listCurrentReservations,
            ));
        }

        $nbPages = ceil(count($listCurrentReservations)/$nbPerPage);

        return $this->render('CVPlatformBundle:Reservation:current.html.twig', array(
            'listCurrentReservations'   => $listCurrentReservations,
            'nbPages'                   => $nbPages,
            'page'                      => $page,
        ));
    }

    public function pastReservationsAction($page, Request $request) {      
        $nbPerPage = 5;
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listPastReservations = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Reservation')
        ->pastReservations($page, $nbPerPage, $userId);

        if (count($listPastReservations) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore réservations passées');

            return $this->render('CVPlatformBundle:Reservation:past.html.twig', array(
                'listPastReservations'     => $listPastReservations,
                ));
        }

        $nbPages = ceil(count($listPastReservations)/$nbPerPage);

        return $this->render('CVPlatformBundle:Reservation:past.html.twig', array(
            'listPastReservations'  => $listPastReservations,
            'nbPages'           => $nbPages,
            'page'              => $page,
        ));
    }

    public function myReservationsAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           

        $nbPerPage = 5;
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listReservations = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Reservation')
        ->myReservations($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listReservations)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Reservation:my_reservations.html.twig', array(
            'listReservations'  => $listReservations,
            'nbPages'           => $nbPages,
            'page'              => $page,
        ));
    }
}
