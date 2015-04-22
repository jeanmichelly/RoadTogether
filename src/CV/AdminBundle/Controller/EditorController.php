<?php

namespace CV\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditorController extends Controller
{
    public function homeNewsAction(Request $request)
    {
    	
    	$form = $this->get('form.factory')->createBuilder('form')
            ->add('news',   'textarea', array('data' => $this->renderView('CVPlatformBundle::news.html.twig')))
            ->add('enregistrer', 'submit')
            ->getForm()
        ;

        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('notice', 'La page d\'accueil a bien été mise à jour.');
            file_put_contents('../src/CV/PlatformBundle/Resources/views/news.html.twig', $form->get('news')->getData());
        }
        return $this->render('CVAdminBundle:Editor:home-news.html.twig', array('form' => $form->createView()));
    }
}