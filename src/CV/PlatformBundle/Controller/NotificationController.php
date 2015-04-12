<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Reservation;
use CV\PlatformBundle\Entity\Rating;

class NotificationController extends Controller
{
    public function myNotificationsAction($page, Request $request) {
		if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           
        $nbPerPage = 5;
        
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
       	
        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Notification')
            ->update($userId);
        
        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->updateStates($userId);

		$listPastReservationsToNotify = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->pastReservations($page, $nbPerPage, $userId);

		$nbPages = ceil(count($listPastReservationsToNotify)/$nbPerPage);

        return $this->render('CVPlatformBundle:Notification:my_notifications.html.twig', array(
        	'listPastReservationsToNotify' 	=> $listPastReservationsToNotify,
       		'nbPages'           			=> $nbPages,
			'page'              			=> $page,
        ));
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
