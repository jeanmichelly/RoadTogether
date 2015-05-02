<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Reservation;
use CV\PlatformBundle\Entity\Rating;
use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Notification;
use CV\PlatformBundle\Form\RatingType;
use CV\UserBundle\Entity\User;

class RatingController extends Controller
{
    public function receivedAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsReceived = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->ratingsReceived($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listRatingsReceived)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Rating:received.html.twig', array(
            'listRatingsReceived'   => $listRatingsReceived,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

    public function sendedAction($page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsSended = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->ratingsSended($page, $nbPerPage, $userId);

        $nbPages = ceil(count($listRatingsSended)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Rating:sended.html.twig', array(
            'listRatingsSended'   => $listRatingsSended,
            'nbPages'               => $nbPages,
            'page'                  => $page,
        ));
    }

    public function leaveAction(Rating $rating, Request $request) {
        $session = $request->getSession();
        $form = $this->createForm(new RatingType, $rating);

        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('info', 'Avis bien publié.');
        
            $rating->setDate(new \Datetime());
            $rating->setState(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rating);
            $em->flush();

            $userId = $this->get('security.context')->getToken()->getUser()->getId();
            if ( $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') ) {
                $numberNotify = $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Rating')
                    ->numberOfNotification($userId);
                $numberNotify += $this->getDoctrine()->getManager()->getRepository('CVPlatformBundle:Payment')
                    ->numberOfNotification($userId);
            }
            $session->set('numberNotify', $numberNotify);

            return $this->redirect($this->generateUrl('cv_platform_ratings_sended'));
        }

        return $this->render('CVPlatformBundle:Rating:leave.html.twig', array(
            'form' => $form->createView(),
            'rating' => $rating,
        ));
    }

    public function pictureAction($thumb, User $user) {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('CVProfileBundle:Profile')
                  ->requestProfileUser($user->getId());

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }         
        return $this->render('CVPlatformBundle:Rating:picture.html.twig', array(
            'profile'   => $profile,
            'thumb'     => $thumb
        ));
    }
}
