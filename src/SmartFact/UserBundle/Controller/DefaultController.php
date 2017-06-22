<?php

namespace SmartFact\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SmartFactUserBundle:Default:index.html.twig');
    }
}
