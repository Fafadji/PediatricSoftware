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

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
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
        }

        return $this->render('PSCustomerBundle:Patient:test.html.twig', array(
          'form' => $form->createView(),
        ));

    }
    //TODO
    public function viewAction()
    {
        return $this->render('PSCustomerBundle:Customer:index.html.twig');
    }
}
