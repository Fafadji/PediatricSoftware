<?php

namespace PS\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



class PatientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        PersonFormUtils::addPrimaryInfo($builder);
        $builder 
            ->add('sex',ChoiceType::class,
                array(
                    'label' => 'sex.required',
                    'choices' => array(
                        'male' => 'male',
                        'female' => 'female'),
                    'multiple'=>false,'expanded'=>true
                    ))
            ->add('codeSiblings',        TextType::class,  array('required' => false, 'label' => 'patient.code.siblings'))
            ->add('comment',        TextType::class,  array('required' => false, 'label' => 'comment'))
             
             ->add('mother', EntityType::class, array(
                    'class'        => 'PSCustomerBundle:Mother',
                    'choice_label' => 'name', 'multiple' => false,
                    'required' => false, 'label' => false,
                    
                  ))
                
            ->add('createNewMotherCB', CheckboxType::class, array(
                    'label'    => 'create.new.mother',
                    'required' => false,
                    'mapped'   => false
                ))
                
            ->add('motherNew',        MotherType::class,  array('required' => false, 'label' => false, 'mapped'   => false,))
            ->add('father',        FatherType::class,  array('required' => false, 'label' => false))
                
            ->add('save',           SubmitType::class, array('label' => 'save'))
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
        return 'ps_customerbundle_patient';
    }


}
