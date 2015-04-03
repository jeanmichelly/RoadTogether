<?php

namespace CV\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\ProfileBundle\Form\ProfileType;

class ProfileController extends Controller
{

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

    public function pictureAction() {
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('CVProfileBundle:Profile')
                  ->requestProfileUser($userId);

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }         
        return $this->render('CVProfileBundle::picture.html.twig', array(
            'profile' => $profile
        ));
    }
}
