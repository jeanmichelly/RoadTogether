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

        $request->getSession()->getFlashBag()->add('notice', 'Vous avez bien reçu votre argent.');

        return $this->redirect($this->generateUrl('cv_platform_my_notifications'));
    }
}