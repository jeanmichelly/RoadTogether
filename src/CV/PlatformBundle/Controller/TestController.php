<?php
namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Ride;

class TestController extends Controller {
	public function indexAction(){
        $repositoryUser = $this->getDoctrine()->getManager()->getRepository('CVUserBundle:User');
        $session = $this->getRequest()->getSession();
        $session->set('user', $repositoryUser->find(29));

		return $this->render('CVPlatformBundle:Test:test_requests.html.twig');
	}

    public function requestRidesFilteredAction() {
   		$repository = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Ride');
		$listRides = $repository->requestRidesFiltered('Troyes', 'Marolle sur seine', '1970-01-05 00:00:00');

     	return $this->render('CVPlatformBundle:Test:request_rides_filtered.html.twig', array('list_rides' => $listRides));
    }

    public function ongoingRidesUserAction() {
        $session = $this->getRequest()->getSession();
     	$repositoryRide = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Ride');
  		$listRides = $repositoryRide->requestOngoingRidesUser( $session->get('user'), 2);

     	return $this->render('CVPlatformBundle:Test:request_ongoing_rides_user.html.twig', array('list_rides' => $listRides));
    }

}