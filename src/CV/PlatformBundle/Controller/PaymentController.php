<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Reservation;
use CV\PlatformBundle\Entity\Rating;

class PaymentController extends Controller
{
    public function validateAction(Request $request) {    
        $session = $request->getSession();
        
        $notifId = $this->container->get('request')->get('notifId');

        $em = $this->getDoctrine()->getManager();
        $payment = $em->getRepository('CVPlatformBundle:Payment')->find($notifId);
        $payment->setState(1);
        $user = $this->get('security.context')->getToken()->getUser();
        $user->setBalance($user->getBalance()+$payment->getAmount());

        $em->persist($user);
        $em->flush();

        if ( $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') ) {
            $numberNotify = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Rating')
                ->numberOfNotification($user->getId());
            $numberNotify += $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Payment')
                ->numberOfNotification($user->getId());
        }
        $session->set('numberNotify', $numberNotify);

        $request->getSession()->getFlashBag()->add('notice', 'Vous avez bien reçu votre argent.');

        return $this->redirect($this->generateUrl('cv_platform_my_notifications'));
    }
}