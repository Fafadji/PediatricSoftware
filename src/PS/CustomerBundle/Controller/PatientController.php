<?php

namespace PS\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\CustomerBundle\Form\PatientType;

use PS\CustomerBundle\Entity\Mother;

class PatientController extends Controller
{   
    public function addOrEditAction(Request $request, Patient $patient = null)
    {     
        // here if $patient is not set, then we are in the Add action
        // We then need to create a new instance of Patient
        if (!isset($patient)) {
            $patient = new Patient();
        }


        $form   = $this->createForm(PatientType::class, $patient );

        if ( $request->isMethod('POST') )
        {
            if ($form->handleRequest($request)->isValid()) {
                
                
                $createNewMotherCB = $form->get('createNewMotherCB')->getData();
                $motherNew = $form->get('motherNew')->getData();
                
                if($createNewMotherCB) {
                    $patient->setMother($motherNew);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($patient);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Patient Registered');

                return $this->redirectToRoute('ps_patient_view', array('id' => $patient->getId()));
            } else {
               $request->getSession()->getFlashBag()->add('error', 'Patient Non Enregistré. Merci de corriger les erreurs');
            }
        }

        return $this->render('PSCustomerBundle:Patient:add.html.twig', array(
          'form' => $form->createView(),
        ));

    }

    
    public function viewAction(Patient $patient)
    {
        return $this->render('PSCustomerBundle:Patient:view.html.twig', ['patient' => $patient]);
    }
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listPatients = $em->getRepository('PSCustomerBundle:Patient')->findAll();
        return $this->render('PSCustomerBundle:Patient:index.html.twig', 
                ['listPatients' => $listPatients]);
    }
}
