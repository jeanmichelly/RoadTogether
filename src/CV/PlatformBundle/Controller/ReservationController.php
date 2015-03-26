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
    public function reservationRideAction($id) {
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
    
    public function confirmReservationRideAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $ride = $em->getRepository('CVPlatformBundle:Ride')->find($id);

        if (null === $ride) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('confirm-reservation-ride', "La réservation a bien été effectuée.");

            $reservation = new Reservation($ride, $this->get('security.context')->getToken()->getUser());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();            

            return $this->redirect($this->generateUrl('cv_platform_reservation_ride', array(
                'id' => $ride->getId(),
            )));
        }

        return $this->render('CVPlatformBundle:Ride:confirm-reservation-ride.html.twig', array(
            'ride' => $ride,
            'form'   => $form->createView(),
        ));
    }

}