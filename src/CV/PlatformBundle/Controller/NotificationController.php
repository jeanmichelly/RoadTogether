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

		$listNotifications = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Notification')
            ->myNotifications($page, $nbPerPage, $userId);

		$nbPages = ceil(count($listNotifications)/$nbPerPage);

        return $this->render('CVPlatformBundle:Notification:my_notifications.html.twig', array(
        	'listNotifications'      => $listNotifications,
       		'nbPages'                => $nbPages,
			'page'                   => $page,
        ));
    }

    public function deleteAction(Request $request) {    
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        $notifId = $this->container->get('request')->get('notifId');

        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository('CVPlatformBundle:Notification')->find($notifId);
        $notification->setState(1);
        $em->flush();

        return $this->redirect($this->generateUrl('cv_platform_my_notifications'));
    }
}
