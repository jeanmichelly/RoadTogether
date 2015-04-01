<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Ride;

class PublicMessageController extends Controller
{
    public function addAction(Ride $ride) {

        $content = $this->container->get('request')->get('content');
        $em = $this->getDoctrine()->getManager();
        $publicMessage = new PublicMessage($content, $ride, $this->get('security.context')->getToken()->getUser());
        $em->persist($publicMessage);
        $em->flush();            
 
        return $this->render('CVPlatformBundle:PublicMessage:view.html.twig', array('publicMessage' => $publicMessage));
    }

    public function messagesReceivedAction($page) {
    	if ($page < 1) {
          	throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listMessagesReceived = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->messagesReceived($page, $nbPerPage, $userId)
        ;

        $nbPages = ceil(count($listMessagesReceived)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:PublicMessage:messages_received.html.twig', array(
            'listMessagesReceived'    => $listMessagesReceived,
            'nbPages'                 => $nbPages,
            'page'                    => $page,
        ));
    }

    public function messagesSendedAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }           

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listMessagesSended = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->messagesSended($page, $nbPerPage, $userId)
        ;

        $nbPages = ceil(count($listMessagesSended)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:PublicMessage:messages_sended.html.twig', array(
            'listMessagesSended'    => $listMessagesSended,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }
}
