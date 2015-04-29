<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Form\RideSearchType;

class PlatformController extends Controller
{
    public function indexAction(Request $request) {
        $session = $request->getSession();

        $ride = new Ride();
        $form = $this->createForm(new RideSearchType, $ride);

        if ($form->handleRequest($request)->isValid()) {
            $form = $form->getData();
            $departureDateToUrl = strtr($form->getDepartureDate(), '/', '-');
            $form->setDepartureDate($departureDateToUrl);

            return $this->redirect($this->generateUrl('cv_platform_focus_rides', array(
                'departure' => $form->getDeparture(),
                'arrival' => $form->getArrival(),
                'departureDate' => $form->getDepartureDate(),
            )));
        } else if ($form->isSubmitted()) {
            return $this->render('CVPlatformBundle:Ride:search.html.twig', array('form' => $form->createView()));
        }

        $userId = $this->get('security.context')->getToken()->getUser();

        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Notification')
            ->update($userId);

        $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Reservation')
            ->updateStates($userId);

        $numberNotify = 0;

        if ( $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') ) {
            $numberNotify = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Notification')
                ->numberOfUser($userId);
        }
        $session->set('numberNotify', $numberNotify);

        return $this->render('CVPlatformBundle::index.html.twig', array('form' => $form->createView()));
    }
}
