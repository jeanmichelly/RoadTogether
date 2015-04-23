<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListeController extends Controller
{
    public function publicMessagesAction() {
        return $this->render('CVAdminBundle:Liste:public_messages.html.twig', array(

        ));
    }

    public function ratingsAction() {
        return $this->render('CVAdminBundle:Liste:ratings.html.twig', array(

        ));
    }
}
