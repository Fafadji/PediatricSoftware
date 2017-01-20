<?php

namespace PS\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\ConsultationBundle\Entity\Consultation;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class ConsultationController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSConsultationBundle:Consultation:index.html.twig');
    }
    
    public function newAction(Request $request, Patient $patient)
    {
        $consultation = new Consultation($patient);
        $forms = [];
        $this->createFormsConsultation($consultation, $forms);
        
        return $this->render('PSConsultationBundle:Consultation:new.html.twig', ['forms' => $forms]);
    }
    
    public function createFormsConsultation($consultation, &$forms)
    {      
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $consultation);
        $formBuilder
            ->add('date', DateType::class, ['format' => 'dd MM yyyy'])
            ->add('patientID', HiddenType::class, ['data' => $consultation->getPatient()->getId(), 'mapped' => false])
            ->add('formType', HiddenType::class, ['data' => 'formDate', 'mapped' => false])
            ->add('edit', SubmitType::class, array('label' => 'edit'))
            ->add('save', SubmitType::class, array('label' => 'save'))
            ->setAction($this->generateUrl('ps_consultation_save'))
            ->setMethod('POST')
        ;
        $formDate = $formBuilder->getForm();
        $forms['formDate'] = $formDate->createView();
        
        $this->createFormsConsultationByParam($consultation, $forms, 'interview');
        $this->createFormsConsultationByParam($consultation, $forms, 'clinicExamination');
    }
    
    public function createFormsConsultationByParam($consultation, &$forms, $param) 
    {
        $formParam = 'form'.ucfirst($param);
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $consultation);
        $formBuilder
            ->add($param, TextareaType::class)
            ->add('patientID', HiddenType::class, ['data' => $consultation->getPatient()->getId(), 'mapped' => false])
            ->add('formType', HiddenType::class, ['data' => $formParam, 'mapped' => false])
            ->add('edit', SubmitType::class, array('label' => 'edit'))
            ->add('save', SubmitType::class, array('label' => 'save'))
            ->setAction($this->generateUrl('ps_consultation_save'))
            ->setMethod('POST')
        ;
        
        $forms[$formParam] = $formBuilder->getForm()->createView();
    }
    
    
    public function saveAction(Request $request)
    {
        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        
        $patientID = $request->query->get('patientID');
        $formType = $request->query->get('formType');
        
        $em = $this->getDoctrine()->getManager();
        $patient = $em
              ->getRepository('PS\ConsultationBundle\Repository\ConsultationRepository')
              ->find($patientID);
        
        $consultation = new Consultation($patient);
        $forms = [];
        $this->createFormsConsultation($consultation, $forms);
        
        $form = $forms[$formType]; 
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultation);
            $em->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        return new JsonResponse(array('message' => 'Error!'), 400);
    }
}
