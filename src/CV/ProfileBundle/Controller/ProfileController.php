<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\ProfileType;
use CV\UserBundle\Entity\User;

class ProfileController extends Controller
{
    public function viewAction(Request $request, User $user) {
        $profile = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVProfileBundle:Profile')
        ->requestProfileUser($user->getId());

        $listRatingsReceived = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->ratingsReceivedWithoutPaginator($user->getId());

        $totalEvaluation = $this->getDoctrine()
        ->getManager()
        ->getRepository('CVPlatformBundle:Rating')
        ->totalEvaluation($user->getId());

        if ( $totalEvaluation != 0 ) {
            $countEvaluation1 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($user->getId(), 1);        

            $countEvaluation2 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($user->getId(), 2);        

            $countEvaluation3 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($user->getId(), 3);        

            $countEvaluation4 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($user->getId(), 4);

            $countEvaluation5 = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVPlatformBundle:Rating')
            ->countEvaluation($user->getId(), 5);

            $avgEvaluations = ($countEvaluation1*1 + $countEvaluation2*2 + $countEvaluation3*3 + $countEvaluation4*4 + $countEvaluation5*5) / $totalEvaluation;  
        } else {
            $countEvaluation1 = 0;
            $countEvaluation2 = 0;
            $countEvaluation3 = 0;
            $countEvaluation4 = 0;
            $countEvaluation5 = 0;
            $avgEvaluations = 0;
            $totalEvaluation = -1;
        }

        return $this->render('CVProfileBundle::view.html.twig', array(
            'profile'                   => $profile,
            'listRatingsReceived'       => $listRatingsReceived,
            'totalEvaluation'           => $totalEvaluation,
            'evaluation1ToPercent'      => $countEvaluation1*100/$totalEvaluation,
            'evaluation2ToPercent'      => $countEvaluation2*100/$totalEvaluation,
            'evaluation3ToPercent'      => $countEvaluation3*100/$totalEvaluation,
            'evaluation4ToPercent'      => $countEvaluation4*100/$totalEvaluation,
            'evaluation5ToPercent'      => $countEvaluation5*100/$totalEvaluation,
            'avgEvaluations'            => $avgEvaluations,
            ));
    }

    public function editAction(Request $request) {

        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('CVProfileBundle:Profile')
        ->requestProfileUser($userId);

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }

        $form = $this->createForm(new ProfileType, $profile);


        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Profil bien modifié');

            return $this->redirect($this->generateUrl('cv_profile_edit', array('id' => $profile->getId())));
        }
        return $this->render('CVProfileBundle::edit.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    public function pictureAction($thumb, User $user) {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('CVProfileBundle:Profile')
        ->requestProfileUser($user->getId());

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }         
        return $this->render('CVProfileBundle::picture.html.twig', array(
            'profile'   => $profile,
            'thumb'     => $thumb
            ));
    }
}
