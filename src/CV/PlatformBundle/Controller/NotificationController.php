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
            ->getRepository('CVPlatformBundle:Rating')
            ->updateToNotify($userId);

        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Payment')
            ->updateToNotify($userId);

		$listRatingNotifications = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->myNotifications($page, $nbPerPage, $userId);

        $listPaymentNotifications = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Payment')
            ->myNotifications($userId);

		$nbPages = ceil(count($listRatingNotifications)/$nbPerPage);

        return $this->render('CVPlatformBundle:Notification:my_notifications.html.twig', array(
        	'listRatingNotifications'      => $listRatingNotifications,
            'listPaymentNotifications'     => $listPaymentNotifications,
       		'nbPages'                      => $nbPages,
			'page'                         => $page,
        ));
    }

    public function deleteRatingNotificationAction(Request $request) {    
        $session = $request->getSession();
        
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        $notifId = $this->container->get('request')->get('notifId');

        $em = $this->getDoctrine()->getManager();
        $rating = $em->getRepository('CVPlatformBundle:Rating')->find($notifId);
        $rating->setState(2);
        $em->flush();

        if ( $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') ) {
            $numberNotify = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Rating')
                ->numberOfNotification($userId);
        }
        $session->set('numberNotify', $numberNotify);

        return $this->redirect($this->generateUrl('cv_platform_my_notifications'));
    }
}
