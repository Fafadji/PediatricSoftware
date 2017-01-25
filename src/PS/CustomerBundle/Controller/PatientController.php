<?php

namespace PS\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\CustomerBundle\Form\PatientType;

class PatientController extends Controller
{   
    public function manageParent($patient, $form, $parentType) {
        // check if new parent creation is requested
        // if yes, then set parent to the new parent
        $setParentMethod = 'set'.ucfirst($parentType);
        $parentActionSelector = $form->get($parentType . '_action_selector')->getData();
        $parentNew = $form->get($parentType . '_new')->getData();

        if($parentActionSelector == 'create') {
            $patient->$setParentMethod($parentNew);
        } else if ($parentActionSelector == 'none') {
            $patient->$setParentMethod(null);
        }
    }
    
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
                $this->manageParent($patient, $form, 'mother');
                
                // check if new father creation is requested
                // if yes, then set father to the new father
                $this->manageParent($patient, $form, 'father');
                

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
        // $listPatients = $em->getRepository('PSCustomerBundle:Patient')->findAll();
        $listPatients = $em->getRepository('PSCustomerBundle:Patient')->getPatientWithParentsAndAddress() ;
        return $this->render('PSCustomerBundle:Patient:index.html.twig', 
                ['listPatients' => $listPatients]);
    }
}
