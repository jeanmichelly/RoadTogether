<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\PrivateMessage;
use CV\UserBundle\Entity\User;

class PrivateMessageController extends Controller
{

    public function addAction(Request $request, User $relatedUser) {

      $privateMessage = new PrivateMessage();

      $form = $this->get('form.factory')->createBuilder('form', $privateMessage)
      ->add('content',   'textarea')
      ->add('enregistrer',      'submit')
      ->getForm()
    ;

    $form->handleRequest($request);


        if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $privateMessage->setUser($this->get('security.context')->getToken()->getUser());
      $privateMessage->setRelatedUser($relatedUser);
      $em->persist($privateMessage);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Message bien transmis');

      return $this->redirect($this->generateUrl('cv_profile_view', array('id' => $privateMessage->getRelatedUser()->getId())));
    }
         
    return $this->render('CVPlatformBundle:PrivateMessage:add.html.twig', array(
      'form' => $form->createView(),
      'relatedUser' => $relatedUser,
    ));
    }


        public function messagesReceivedAction($page, Request $request) {
        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $listMessagesReceived = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PrivateMessage')
            ->messagesReceived($page, $nbPerPage, $userId)
        ;

        if(count($listMessagesReceived) == 0){
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de messages reçus');


        return $this->render('CVPlatformBundle:PrivateMessage:messages_received.html.twig', array(
            'listMessagesReceived'     => $listMessagesReceived,
        ));
        }

        $nbPages = ceil(count($listMessagesReceived)/$nbPerPage);

        return $this->render('CVPlatformBundle:PrivateMessage:messages_received.html.twig', array(
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
            ->getRepository('CVPlatformBundle:PrivateMessage')
            ->messagesSended($page, $nbPerPage, $userId)
        ;

        if(count($listMessagesSended) == 0){
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore de messages laissés');


        return $this->render('CVPlatformBundle:PrivateMessage:messages_sended.html.twig', array(
            'listMessagesSended'     => $listMessagesSended,
        ));
        }

        $nbPages = ceil(count($listMessagesSended)/$nbPerPage);

        return $this->render('CVPlatformBundle:PrivateMessage:messages_sended.html.twig', array(
            'listMessagesSended'    => $listMessagesSended,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

}
