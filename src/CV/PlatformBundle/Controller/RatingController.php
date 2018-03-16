<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use CV\PlatformBundle\Entity\Reservation;
use CV\PlatformBundle\Entity\Rating;
use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Entity\PublicMessage;
use CV\PlatformBundle\Entity\Notification;
use CV\PlatformBundle\Form\RatingType;
use CV\UserBundle\Entity\User;

class RatingController extends Controller
{
    public function receivedAction(Request $request) {

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsReceived = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->ratingsReceived($userId);

        if (count($listRatingsReceived) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore d\'avis reçus');
        }

        $totalEvaluation = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->totalEvaluation($userId);

        if ( $totalEvaluation != 0 ) {
            $countEvaluation1 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($userId, 1);        

            $countEvaluation2 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($userId, 2);        

            $countEvaluation3 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($userId, 3);        

            $countEvaluation4 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($userId, 4);

            $countEvaluation5 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($userId, 5);
        } else {
            $countEvaluation1 = 0;
            $countEvaluation2 = 0;
            $countEvaluation3 = 0;
            $countEvaluation4 = 0;
            $countEvaluation5 = 0;
            $avgEvaluations = 0;
            $totalEvaluation = -1;
        }

        return $this->render('CVPlatformBundle:Rating:received.html.twig', array(
            'listRatingsReceived'   => $listRatingsReceived,
            'totalEvaluation'       => $totalEvaluation,
            'countEvaluation1'      => $countEvaluation1,
            'countEvaluation2'      => $countEvaluation2,
            'countEvaluation3'      => $countEvaluation3,
            'countEvaluation4'      => $countEvaluation4,
            'countEvaluation5'      => $countEvaluation5
        ));
    }

    public function sendedAction(Request $request) {

        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        
        $listRatingsSended = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->ratingsSended($userId);

        if (count($listRatingsSended) == 0) {
            $request->getSession()->getFlashBag()->add('info', 'Vous n\'avez pas encore d\'avis laissés');
        }

        return $this->render('CVPlatformBundle:Rating:sended.html.twig', array(
            'listRatingsSended'   => $listRatingsSended,
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

    public function avgEvaluationsAction() {
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $avgEvaluations = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->avgEvaluations($userId);

        return new Response($avgEvaluations);
    }

    public function avgDrivingAction() {
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $avgDriving = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->avgDriving($userId);

        return new Response($avgDriving);
    }

    public function avgEvaluationsOfUserAction(User $user) {
        $avgEvaluations = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->avgEvaluations($user);

        return new Response($avgEvaluations);
    }

    public function totalEvaluationOfUserAction(User $user) {
        $totalEvaluation = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->totalEvaluation($user);

        return new Response($totalEvaluation);
    }

}
