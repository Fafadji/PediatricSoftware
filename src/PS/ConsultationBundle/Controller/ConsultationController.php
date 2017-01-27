<?php

namespace PS\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\ConsultationBundle\Entity\Consultation;
use PS\ConsultationBundle\Form\ConsultationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;


class ConsultationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listConsultations = $em->getRepository('PSConsultationBundle:Consultation')->findAll();
        //$listConsultations = $em->getRepository('PSConsultationBundle:Consultation')->getConultationWithFullPatient() ;
        
        return $this->render('PSConsultationBundle:Consultation:index.html.twig', ['listConsultations' => $listConsultations]);
    }
    
    public function newAction(Request $request, Patient $patient)
    {
        $consultation = new Consultation($patient);
        $form   = $this->createForm(ConsultationType::class, $consultation, array(
            'action' => $this->generateUrl('ps_consultation_save', ['patient_id' => $patient->getId()]),
            'method' => 'POST') );
        
        return $this->render('PSConsultationBundle:Consultation:new.html.twig', ['form' => $form->createView()]);
        
        //$forms = [];
        //$formsView = [];
        //$this->createFormsConsultation($consultation, $forms, $formsView);
        
        
    }
    
    
  /**
  *
  * @ParamConverter("patient", options={"mapping": {"patient_id" : "id"}})
  * @ParamConverter("consultation", options={"mapping": {"consultation_id"   : "id"}})
  *
  */
    public function addOrEditAction(Request $request, Patient $patient, Consultation $consultation = null)
    {
        $urlOptions = ['patient_id' => $patient->getId()];
        if($consultation == null) {
            $consultation = new Consultation($patient);
        } else {
            $urlOptions['consultation_id'] = $consultation->getId();
        }
        $form   = $this->createForm(ConsultationType::class, $consultation, array(
            'action' => $this->generateUrl('ps_consultation_add_or_edit', $urlOptions),
            'method' => 'POST') );

        
        if ($request->isXmlHttpRequest()) {
            $form->handleRequest($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($consultation);
                $em->flush();
                return new JsonResponse(array('message' => 'Consultation sauvegardé avec succès!', 'consultation_id' => $consultation->getId()), 200);
            }
            return new JsonResponse(array('message' => 'Error in add method!'), 400);

        } else {
            return $this->render('PSConsultationBundle:Consultation:add_or_edit.html.twig', ['form' => $form->createView()]);
        }
    }
}
