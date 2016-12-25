<?php

namespace PS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSCoreBundle:Default:index.html.twig');
    }
}
