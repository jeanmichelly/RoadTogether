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
    public function addAction(Ride $ride) {
        
        $listPublicMessagesOfRide = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->publicMessagesOfRide($ride);

        return $this->render('CVPlatformBundle:Reservation:view.html.twig', array(
              'ride'                        => $ride,
              'listPublicMessagesOfRide'    => $listPublicMessagesOfRide,
        ));
    }
    
    public function confirmAction(Ride $ride, Request $request) {
     
        $reservation = new Reservation($ride, $this->get('security.context')->getToken()->getUser());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();            

        return $this->redirect($this->generateUrl('cv_platform_reservation_ride', array(
            'id' => $ride->getId(),
        )));
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
