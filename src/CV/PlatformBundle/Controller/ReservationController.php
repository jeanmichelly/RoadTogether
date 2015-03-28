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

        return $this->render('CVPlatformBundle:Reservation:view.html.twig', array(
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

    public function myReservationsAction($page){
        if ($page < 1) {
          throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           

            // Ici je fixe le nombre d'annonces par page à 3
        // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
            // On récupère notre objet Paginator
        $listReservations = $this->getDoctrine()
          ->getManager()
          ->getRepository('CVPlatformBundle:Reservation')
          ->myReservations($page, $nbPerPage, $userId)
        ;

            // On calcule le nombre total de pages grâce au count($listRides) qui retourne le nombre total d'annonces
          $nbPages = ceil(count($listReservations)/$nbPerPage);

          // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
          throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

            // On donne toutes les informations nécessaires à la vue
        return $this->render('CVPlatformBundle:Reservation:my_reservations.html.twig', array(
          'listReservations' => $listReservations,
          'nbPages'     => $nbPages,
          'page'        => $page,
        ));
    }

}