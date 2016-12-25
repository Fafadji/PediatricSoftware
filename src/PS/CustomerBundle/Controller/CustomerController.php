<?php

namespace PS\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSCustomerBundle:Customer:index.html.twig');
    }
    
    public function addPatientAction()
    {
        return $this->render('PSCustomerBundle:Customer:index.html.twig');
    }
}
