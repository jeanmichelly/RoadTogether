<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlatformController extends Controller
{
    public function indexAction(Request $request) {
        $form = $this->get('form.factory')->createBuilder('form')
            ->add('departure',          'text',     array('data' => 'Marolle sur seine'))
            ->add('arrival',            'text',     array('data' => 'Troyes'))
            ->add('departure_date',     'text',     array('data' => '2015/03/02'))
            ->add('rechercher',         'submit')
            ->getForm();


        if ($form->handleRequest($request)->isValid()) {
            $departureDateToUrl = strtr($form->get('departure_date')->getData(), '/', '-');
            return $this->redirect($this->generateUrl('cv_platform_focus_rides', 
                array(
                    'departure' => $form->get('departure')->getData(),
                    'arrival' => $form->get('arrival')->getData(),
                    'departure_date' => $departureDateToUrl,
     
                )));
        }
        return $this->render('CVPlatformBundle::index.html.twig', array('form' => $form->createView()));
    }
}