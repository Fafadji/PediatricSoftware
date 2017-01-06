<?php

namespace PS\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\CustomerBundle\Form\PatientType;

class PatientController extends Controller
{   
    public function addAction(Request $request)
    {
        $patient = new Patient();
        $form   = $this->createForm(PatientType::class, $patient);

        if ( $request->isMethod('POST') )
        {
            if ($form->handleRequest($request)->isValid()) {
                // On crée l'évènement avec ses 2 arguments
                //$event = new MessagePostEvent($advert->getContent(), $advert->getUser());

                // On déclenche l'évènement
                //$this->get('event_dispatcher')->dispatch(PlatformEvents::POST_MESSAGE, $event);

                // On récupère ce qui a été modifié par le ou les listeners, ici le message
                //$advert->setContent($event->getMessage());

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
