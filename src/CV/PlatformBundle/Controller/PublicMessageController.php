<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Ride;
use CV\UserBundle\Entity\User;

class PublicMessageController extends Controller
{
    public function addAction(Ride $ride) {
        $content = $this->container->get('request')->get('content');
        $em = $this->getDoctrine()->getManager();
        $publicMessage = new PublicMessage($content, $ride, $this->get('security.context')->getToken()->getUser());
        $em->persist($publicMessage);
        $em->flush();            
 
        return $this->render('CVPlatformBundle:PublicMessage:view.html.twig', array(
            'ride'          => $ride, 
            'publicMessage' => $publicMessage,
        ));
    }

    public function messagesReceivedAction($page, Request $request) {
        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listMessagesReceived = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->messagesReceived($page, $nbPerPage, $userId)
        ;

        if(count($listMessagesReceived) == 0){
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de messages reçus');


        return $this->render('CVPlatformBundle:PublicMessage:messages_received.html.twig', array(
            'listMessagesReceived'     => $listMessagesReceived,
        ));
        }

        $nbPages = ceil(count($listMessagesReceived)/$nbPerPage);

        return $this->render('CVPlatformBundle:PublicMessage:messages_received.html.twig', array(
            'listMessagesReceived'    => $listMessagesReceived,
            'nbPages'                 => $nbPages,
            'page'                    => $page,
        ));
    }

    public function messagesSendedAction($page, Request $request) {
      
        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listMessagesSended = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->messagesSended($page, $nbPerPage, $userId)
        ;

        if(count($listMessagesSended) == 0){
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de messages laissés');


        return $this->render('CVPlatformBundle:PublicMessage:messages_sended.html.twig', array(
            'listMessagesSended'     => $listMessagesSended,
        ));
        }

        $nbPages = ceil(count($listMessagesSended)/$nbPerPage);

        return $this->render('CVPlatformBundle:PublicMessage:messages_sended.html.twig', array(
            'listMessagesSended'    => $listMessagesSended,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

    public function pictureAction($thumb, User $user) {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('CVProfileBundle:Profile')
                  ->requestProfileUser($user->getId());

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }         
        return $this->render('CVPlatformBundle:PublicMessage:picture.html.twig', array(
            'profile'   => $profile,
            'thumb'     => $thumb
        ));
    }
}
