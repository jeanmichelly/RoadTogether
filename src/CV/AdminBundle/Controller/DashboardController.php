<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function viewAction() {
    	$totalRatings = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->totalRatings();

       	$totalPublicMessages = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:PublicMessage')
            ->totalPublicMessages();
        
        return $this->render('CVAdminBundle:Dashboard:view.html.twig', array(
        	'totalRatings'			=> $totalRatings,
        	'totalPublicMessages'	=> $totalPublicMessages,
        ));
    }
}
