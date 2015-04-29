<?php

namespace CV\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AttributeRolesController extends Controller
{
    public function viewAction() {
        $listUsers = $this->getDoctrine()
          ->getManager()
          ->getRepository('CVUserBundle:User')
          ->findAll();
        $listAdmins = array();

        for ($i=0; $i<count($listUsers); $i++) {
            if ( in_array('ROLE_ADMIN', $listUsers[$i]->getRoles()) ) {
                array_push($listAdmins, $listUsers[$i]);
                unset($listUsers[$i]);
            }
        }

        return $this->render('CVAdminBundle:AttributeRoles:view.html.twig', array(
            'listAdmins'    => $listAdmins,
            'listUsers'     => $listUsers,
        ));
    }    

    public function saveAction() {
        $listAdmins = split(',', $this->container->get('request')->get('listAdmins'));
        $listUsers = split(',', $this->container->get('request')->get('listUsers'));

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('CVUserBundle:User')
            ->findAll();

        foreach ($listAdmins as $admin) {
            foreach ($list as $ua) {
                if ( $ua->getUsername() == $admin ){
                    $ua->setRoles(array('ROLE_ADMIN'));
                    $em->persist($ua);
                }
            }
        }

        foreach ($listUsers as $user) {
            foreach ($list as $ua) {
                if ( $ua->getUsername() == $user ){
                    $ua->setRoles(array('ROLE_USER'));
                    $em->persist($ua);
                }
            }
        }

        $em->flush();

        return $this->render('CVAdminBundle:AttributeRoles:save.html.twig', array(
            'listAdmins'    => $listAdmins,
            'listUsers'     => $listUsers, 
            'type' => gettype($listAdmins)   
        ));
    }
}
