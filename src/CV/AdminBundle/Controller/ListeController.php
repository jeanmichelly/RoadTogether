<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListeController extends Controller
{
    public function publicMessagesAction() {
		$listPublicMessages = $this->getDoctrine()
		  	->getManager()
		  	->getRepository('CVPlatformBundle:PublicMessage')
		  	->findAll();

        return $this->render('CVAdminBundle:Liste:public_messages.html.twig', array(
        	'listPublicMessages'	=> $listPublicMessages,
        ));
    }

    public function ratingsAction() {
        $listRatings = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->findAll();
            
        return $this->render('CVAdminBundle:Liste:ratings.html.twig', array(
            'listRatings'    => $listRatings,
        ));
    }
}
