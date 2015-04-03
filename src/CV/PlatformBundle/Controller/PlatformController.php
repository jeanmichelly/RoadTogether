<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlatformController extends Controller
{
    public function indexAction(Request $request) {
        $form = $this->get('form.factory')->createBuilder('form')
            ->add('departure',          'text',     array('data' => 'Paris'))
            ->add('arrival',            'text',     array('data' => 'Marseille'))
            ->add('departure_date',     'text',     array('data' => '2015/05/01'))
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

        $numberNotify = 0;

        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $numberNotify = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Reservation')
                ->updateStates($this->get('security.context')->getToken()->getUser());
        }

        return $this->render('CVPlatformBundle::index.html.twig', array(
            'form' => $form->createView(),
            'numberNotify' => $numberNotify,
        ));
    }
}
