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
                
                // check if new mother creation is requested
                // if yes, then set mother to the new mother
                $createNewMotherCB = $form->get('create_new_mother_cb')->getData();
                $motherNew = $form->get('mother_new')->getData();
                
                if($createNewMotherCB) {
                    $patient->setMother($motherNew);
                }
                
                // check if new father creation is requested
                // if yes, then set father to the new father
                $createNewFatherCB = $form->get('create_new_father_cb')->getData();
                $fatherNew = $form->get('father_new')->getData();
                
                if($createNewFatherCB) {
                    $patient->setMother($fatherNew);
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
