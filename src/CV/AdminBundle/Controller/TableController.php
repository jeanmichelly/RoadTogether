<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
    public function usersAction() {
        $profiles = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVProfileBundle:Profile')
            ->requestProfileUsers();

        return $this->render('CVAdminBundle:Table:users.html.twig', array(
        	'profiles'	=> $profiles,
        ));
    }

    public function ridesUpcomingAction() {
        $listAllUpcomingRides = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Ride')
            ->allUpcomingRides();

        return $this->render('CVAdminBundle:Table:rides_upcoming.html.twig', array(
        	'listAllUpcomingRides'	=> $listAllUpcomingRides,
        ));
    }
}
