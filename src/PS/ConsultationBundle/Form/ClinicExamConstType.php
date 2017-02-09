<?php

namespace PS\ConsultationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClinicExamConstType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', NumberType::class,  array('label' => 'weight.abbr', 'required' => false, 'attr' => ['class' => 'number bmi_param']))
            ->add('height', NumberType::class,  array('label' => 'height.abbr', 'required' => false, 'attr' => ['class' => 'number bmi_param']))
            ->add('temperature', NumberType::class,  array('label' => 'temperature.abbr', 'required' => false, 'attr' => ['class' => 'number']))
            ->add('bloodPressure', TextType::class,  array('label' => 'blood.pressure.abbr', 'required' => false, 'attr' => ['class' => 'number_format']))       
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\ConsultationBundle\Entity\ClinicExamConst'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_consultationbundle_clinicexamconst';
    }


}
