<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Ride;

class PublicMessageController extends Controller
{
    public function addAction($ride) {
        $content = $this->container->get('request')->get('content');
        $em = $this->getDoctrine()->getManager();
        $ride = $em->getRepository('CVPlatformBundle:Ride')->find($ride);
        $publicMessage = new PublicMessage($content, $ride, $this->get('security.context')->getToken()->getUser());
        
/*        $em->persist($publicMessage);
        $em->flush();    */        
 
        return $this->render('CVPlatformBundle:Ride:public-message.html.twig', array('publicMessage' => $publicMessage));
    }
}