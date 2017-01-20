<?php

namespace PS\ConsultationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class)
            ->add('interview', TextArea::class)
            ->add('clinicExamination')
            ->add('conclusion')
            ->add('checkup')
            ->add('diagnosis')
            ->add('treatment')
            ->add('patient')        
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
