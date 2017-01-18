<?php

namespace PS\CustomerBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonFormUtils
{

    public static function addPrimaryInfo(FormBuilderInterface $builder)
    {
        $builder
            ->add('name',           TextType::class, array('label' => 'name'))
            ->add('surname',        TextType::class,  array('required' => false, 'label' => 'surname'))
            ->add('birthday',       BirthdayType::class,  
                array(
                    'label' => 'birthday',
                    'required' => false,
                    'format' => 'dd MM yyyy',
                    )) ;
    }

    public static function addComment(FormBuilderInterface $builder)
    {
        $builder->add('comment', TextType::class, array('required' => false, 'label' => 'comment'));
    }
    
    public static function buildPersonTypeForm(FormBuilderInterface $builder)
    {
        PersonFormUtils::addPrimaryInfo($builder);
        $builder->add('personalPhone', TextType::class, array('required' => false, 'label' => 'personal.phone'));
        PersonFormUtils::addComment($builder);
    }
    
    public static function builParentTypeForm(FormBuilderInterface $builder, $personType)
    { 
        $builder
            ->add($personType.'_action_selector', ChoiceType::class, array(
                    'label'    => 'action.selection',
                    'choices' => array(
                        'select.existing.'.$personType => 'select',
                        'create.new.'.$personType => 'create',
                        'no.'.$personType => 'none'),
                    'multiple'=>false,'expanded'=>false, 'mapped'   => false
                ))
                
            ->add($personType, EntityType::class, array(
                    'class'        => 'PSCustomerBundle:'.ucfirst($personType),
                    'choice_label' => 'name', 'multiple' => false, 'expanded' => true,
                    'required' => false, 'label' => false,
                    
                  ))
            ->add($personType.'_new',        MotherType::class,  array('required' => false, 'label' => false, 'mapped' => false,))
        ;
    }
}
