<?php

namespace PS\ConsultationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use PS\CustomerBundle\Form\PatientForConsultationType;
use PS\CoreBundle\Form\PSFormUtils;
use PS\ConsultationBundle\Form\ClinicExamConstType;

class ConsultationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class, 
            array(
                'format' => "dd/MM/yyyy", 
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker inline dateFR'],
                'html5' => false,
            ));        
        PSFormUtils::buildEditSaveButtonByParam($builder, 'date');
        
        PSFormUtils::buildTextareaFormByParam($builder, 'interview');
        PSFormUtils::buildTextareaFormByParam($builder, 'clinicExamination');
        PSFormUtils::buildTextareaFormByParam($builder, 'conclusion');
        PSFormUtils::buildTextareaFormByParam($builder, 'checkup');
        PSFormUtils::buildTextareaFormByParam($builder, 'diagnosis');
        PSFormUtils::buildTextareaFormByParam($builder, 'treatment');

        $builder
            ->add('editConsultation1', SubmitType::class, array('label' => 'edit.consultation'))
            ->add('editConsultation2', SubmitType::class, array('label' => 'edit.consultation')) 
            ->add('saveConsultation1', SubmitType::class, array('label' => 'save.consultation'))   
            ->add('saveConsultation2', SubmitType::class, array('label' => 'save.consultation'))  
                
            ->add('patient', PatientForConsultationType::class, array('label' => false))
            ->add('clinicExamConst', ClinicExamConstType::class, array('label' => false)) 
        ; 
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\ConsultationBundle\Entity\Consultation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_consultationbundle_consultation';
    }


}
