<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DashboardController extends Controller
{
    public function viewAction(Request $request) {
    	$user = $this->get('security.context')->getToken()->getUser();

        $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->updateToNotify($user->getId());

        $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Payment')
        ->updateToNotify($user->getId());

        $listRatingNotifications = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->myNotifications($user->getId());

        $listPaymentNotifications = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Payment')
        ->myNotifications($user->getId());

        return $this->render('CVPlatformBundle:Dashboard:view.html.twig', array(
        	'user_level'				=> $user->getProfile()->getLevel(),
        	'user_preference'			=> $user->getProfile()->getPreference(),
        	'user_registration'			=> $user->getDateRegistration(),
			'listRatingNotifications'	=> $listRatingNotifications,
           	'listPaymentNotifications'	=> $listPaymentNotifications
        ));
    }
}
