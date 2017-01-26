<?php

namespace PS\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;



class PatientForConsultationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        PersonFormUtils::addPrimaryInfo($builder, true);
        PersonFormUtils::addComment($builder, true);
        $builder
            ->add('sex', TextType::class,  array('required' => false, 'label' => 'patient.sex', 'disabled' =>true))
            ->add('codeSiblings', TextType::class,  array('required' => false, 'label' => 'patient.code.siblings', 'disabled' =>true))
            ->add('personalDiseasesHistory', TextareaType::class,  array('required' => false, 'label' => 'patient.personalDiseasesHistory'))
            ->add('familyDiseasesHistory', TextareaType::class,  array('required' => false, 'label' => 'patient.familyDiseasesHistory'))
        ;
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\CustomerBundle\Entity\Patient'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_customerbundle_patient_for_consultation';
    }


}
