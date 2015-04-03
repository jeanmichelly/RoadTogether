<?php

namespace CV\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RatingController extends Controller
{
    public function leaveAction(Request $request) {
       
        return $this->render('CVPlatformBundle:Rating:leave.html.twig');
    }
}
