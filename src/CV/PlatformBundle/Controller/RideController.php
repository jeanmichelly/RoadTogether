<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CV\PlatformBundle\Entity\Ride;
use CV\PlatformBundle\Form\RideType;
use CV\PlatformBundle\Form\RideEditType;
use CV\PlatformBundle\Form\RideViewType;

class RideController extends Controller
{
  public function indexAction($page)
    {

    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    // Ici, on récupérera la liste des annonces, puis on la passera au template

    // Mais pour l'instant, on ne fait qu'appeler le template
    // return $this->render('CVPlatformBundle:Ride:index.html.twig');
    
    // Notre liste d'annonce en dur
    $listRides = array(
      array(
        'title'   => 'Recherche développpeur Symfony2',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );

    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('CVPlatformBundle:Ride:index.html.twig', array(
      'listRides' => $listRides
    ));
  }

 public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listRides = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('CVPlatformBundle:Ride:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listRides' => $listRides
    ));
  }

  public function viewAction($id)
  {

$ride = $this->getDoctrine()
  ->getManager()
  ->getRepository('CVPlatformBundle:Ride')
  ->find($id)
;

  $form = $this->createForm(new RideViewType, $ride,array(
        'read_only' => true
    ));

 return $this->render('CVPlatformBundle:Ride:view.html.twig', array(
      'form' => $form->createView(),
    ));

  }

  public function addAction(Request $request)
  {

    $ride = new Ride();
    $ride->setDepartureDate = new \Datetime();
    $ride->setUser($this->get('security.context')->getToken()->getUser());
    $form = $this->createForm(new RideType, $ride);

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($ride);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      return $this->redirect($this->generateUrl('cv_platform_view', array('id' => $ride->getId())));
    }

    return $this->render('CVPlatformBundle:Ride:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {

        $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $ride = $em->getRepository('CVPlatformBundle:Ride')->find($id);

    if (null === $ride) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

 $form = $this->createForm(new RideEditType, $ride);


    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('cv_platform_view', array('id' => $ride->getId())));
    }

 return $this->render('CVPlatformBundle:Ride:edit.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $ride = $em->getRepository('CVPlatformBundle:Ride')->find($id);

    if (null === $ride) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($ride);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

      return $this->redirect($this->generateUrl('cv_platform_home'));
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('CVPlatformBundle:Ride:delete.html.twig', array(
      'ride' => $ride,
      'form'   => $form->createView(),
    ));
    }

    public function ongoingRidesUserAction($page) {

    if ($page < 1) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

        // Ici je fixe le nombre d'annonces par page à 3
    // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
    $nbPerPage = 5;

    $userId = $this->get('security.context')->getToken()->getUser()->getId();
        // On récupère notre objet Paginator
    $listRides = $this->getDoctrine()
      ->getManager()
      ->getRepository('CVPlatformBundle:Ride')
      ->requestOngoingRidesUser($page, $nbPerPage, $userId)
    ;

        // On calcule le nombre total de pages grâce au count($listRides) qui retourne le nombre total d'annonces
      $nbPages = ceil(count($listRides)/$nbPerPage);

      // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

        // On donne toutes les informations nécessaires à la vue
    return $this->render('CVPlatformBundle:Ride:my-rides.html.twig', array(
      'listRides' => $listRides,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));

    }

public function searchRidesUserAction(Request $request) {
        $form = $this->get('form.factory')->createBuilder('form')
            ->add('departure',        'text', array('data' => 'Marolle sur seine'))
            ->add('arrival',          'text', array('data' => 'Troyes'))
            ->add('departure_date',   'text', array('data' => '2015/03/02'))
            ->add('rechercher', 'submit')
            ->getForm()
        ;

        if ($form->handleRequest($request)->isValid()) {
            $departureDateToUrl = strtr($form->get('departure_date')->getData(), '/', '-');
            return $this->redirect($this->generateUrl('cv_platform_focus_rides', 
                array(
                    'departure' => $form->get('departure')->getData(),
                    'arrival' => $form->get('arrival')->getData(),
                    'departure_date' => $departureDateToUrl,
                )));
        }

        return $this->render('CVPlatformBundle:Ride:search-rides.html.twig', array('form' => $form->createView()));
    }

    public function focusRidesUserAction($departure, $arrival, $departure_date, $page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $listRides = $this->getDoctrine()
          ->getManager()
          ->getRepository('CVPlatformBundle:Ride')
          ->focusRidesUser($departure, $arrival, $departure_date, $page, $nbPerPage)
        ;

        $nbPages = ceil(count($listRides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('CVPlatformBundle:Ride:focus-rides.html.twig', array(
              'listRides' => $listRides,
              'nbPages'     => $nbPages,
              'page'        => $page
        ));
    }

}