<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Reservation;
use CV\PlatformBundle\Entity\Rating;
use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Entity\PublicMessage;

class RatingController extends Controller
{
    public function notificationsAction($page, Request $request) {
		if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           
        $nbPerPage = 5;
        
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
       	
        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->updateStates($userId);

		$listPastReservationsToNotify = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->pastReservations($page, $nbPerPage, $userId);

		$nbPages = ceil(count($listPastReservationsToNotify)/$nbPerPage);

        return $this->render('CVPlatformBundle:Rating:leave.html.twig', array(
        	'listPastReservationsToNotify' 	=> $listPastReservationsToNotify,
       		'nbPages'           			=> $nbPages,
			'page'              			=> $page,
        ));
    }

    public function receivedAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsReceived = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->ratingsReceived($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listRatingsReceived)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Rating:received.html.twig', array(
            'listRatingsReceived'   => $listRatingsReceived,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

    public function sendedAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsSended = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->ratingsSended($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listRatingsSended)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Rating:sended.html.twig', array(
            'listRatingsSended'   => $listRatingsSended,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

    public function leaveAction(Request $request) {    
        return $this->redirect($this->generateUrl('cv_platform_leave_rating'));
    }

    public function deleteNotificationAction(Request $request) {    
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        $resId = $this->container->get('request')->get('resId');
        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->updateState($userId, $resId);
        return $this->redirect($this->generateUrl('cv_platform_ratings_notifications'));
    }
}
