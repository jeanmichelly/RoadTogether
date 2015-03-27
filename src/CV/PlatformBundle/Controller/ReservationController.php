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
    public function addAction($id) {
        $ride = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->find($id)
        ;
        
        $listPublicMessagesOfRide = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->publicMessagesOfRide($ride)
        ;

        return $this->render('CVPlatformBundle:Ride:reservation-ride.html.twig', array(
              'ride' => $ride,
              'listPublicMessagesOfRide' => $listPublicMessagesOfRide,
        ));
    }
    
    public function confirmAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $ride = $em->getRepository('CVPlatformBundle:Ride')->find($id);

        if (null === $ride) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
     
        $reservation = new Reservation($ride, $this->get('security.context')->getToken()->getUser());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();            

        return $this->redirect($this->generateUrl('cv_platform_reservation_ride', array(
            'id' => $ride->getId(),
        )));
    }

}