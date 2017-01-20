<?php

namespace PS\ConsultationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PS\CustomerBundle\Entity\Patient;
use PS\ConsultationBundle\Entity\Consultation;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConsultationController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSConsultationBundle:Consultation:index.html.twig');
    }
    
    public function newAction(Request $request, Patient $patient)
    {
        $consultation = new Consultation($patient);
        $formsConsultation = [];
        $this->createFormsConsultation($consultation, $formsConsultation);
        
        return $this->render('PSConsultationBundle:Consultation:new.html.twig', ['formsConsultation' => $formsConsultation]);
    }
    
    public function createFormsConsultation($consultation, $formsConsultation)
    {      
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $consultation);
        $formBuilder
            ->add('date', DateTimeType::class)
            ->add('edit', SubmitType::class, array('label' => 'edit'))
            ->add('save', SubmitType::class, array('label' => 'save'));
        $formDate = $formBuilder->getForm();
        $formsConsultation['formDate'] = $formDate->createView();
        
        $this->createFormsConsultationByParam($consultation, $formsConsultation, 'interview');
    }
    
    public function createFormsConsultationByParam($consultation, $formsConsultation, $param) 
    {
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $consultation);
        $formBuilder
            ->add($param, TextareaType::class)
            ->add('edit', SubmitType::class, array('label' => 'edit'))
            ->add('save', SubmitType::class, array('label' => 'save'));
        $formParam = 'form'.ucfirst($param);
        $formsConsultation[$formParam] = $formBuilder->getForm()->createView();
    }
}
