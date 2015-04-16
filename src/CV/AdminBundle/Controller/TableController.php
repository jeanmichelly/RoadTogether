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
            dump($profiles);
        return $this->render('CVAdminBundle:Table:users.html.twig', array(
        	'profiles'	=> $profiles,
        ));
    }
}
