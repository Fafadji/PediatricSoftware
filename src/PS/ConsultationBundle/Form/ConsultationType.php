<?php

namespace PS\ConsultationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConsultationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateTimeType::class, ['date_format' => "dd MM yyyy"] );
        $this->buildFormButtonByParam($builder, 'date');
        
        $this->buildTextareaFormByParam($builder, 'interview');
        $this->buildTextareaFormByParam($builder, 'clinicExamination');
        $this->buildTextareaFormByParam($builder, 'conclusion');
        $this->buildTextareaFormByParam($builder, 'checkup');
        $this->buildTextareaFormByParam($builder, 'diagnosis');
        $this->buildTextareaFormByParam($builder, 'treatment');

        $builder
            ->add('editConsultation1', SubmitType::class, array('label' => 'edit.consultation'))
            ->add('editConsultation2', SubmitType::class, array('label' => 'edit.consultation')) 
            ->add('saveConsultation1', SubmitType::class, array('label' => 'save.consultation'))   
            ->add('saveConsultation2', SubmitType::class, array('label' => 'save.consultation'))    
        ; 
    }
    
    public function buildFormButtonByParam(FormBuilderInterface $builder, $param)
    {
        $editButtonName = 'edit'.ucfirst($param);
        $saveButtonName = 'save'.ucfirst($param);
        
        $builder
            ->add($editButtonName, SubmitType::class, array('label' => 'edit'))
            ->add($saveButtonName , SubmitType::class, array('label' => 'save'))
        ;
    }
    
    public function buildTextareaFormByParam(FormBuilderInterface $builder, $param)
    {
        $builder->add($param, TextareaType::class, ['required' => false, 'label' => $param]);
        $this->buildFormButtonByParam($builder, $param);
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
