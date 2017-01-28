<?php

namespace PS\CoreBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use PS\CustomerBundle\Form\MotherType;
use PS\CustomerBundle\Form\FatherType;

class PSFormUtils
{

    public static function addPrimaryInfo(FormBuilderInterface $builder, $disabled = false)
    {
        PSFormUtils::addMinimalInfo($builder, $disabled);
        
        $builder
            ->add('birthday', BirthdayType::class,  
                array(
                    'label' => 'birthday',
                    'attr' => ['class' => 'js-datepicker dateFR'],
                    'html5' => false,
                    'required' => false,
                    'format' => "dd/MM/yyyy",
                    'widget' => 'single_text',
                    'disabled' => $disabled)) ;
    }
    
    public static function addMinimalInfo(FormBuilderInterface $builder, $disabled = false)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'name', 'disabled' => $disabled, 'attr' => ['minlength' => 2]))
            ->add('surname', TextType::class,  array('required' => false, 'label' => 'surname', 'disabled' => $disabled , 'attr' => ['minlength' => 2]))
        ;
    }

    public static function addComment(FormBuilderInterface $builder, $disabled = false)
    {
        $builder->add('comment', TextType::class, array('required' => false, 'label' => 'comment', 'disabled' => $disabled));
    }
    
    public static function buildPersonTypeForm(FormBuilderInterface $builder)
    {
        PSFormUtils::addPrimaryInfo($builder);
        $builder->add('personalPhone', TextType::class, array('required' => false, 'label' => 'personal.phone', 'attr' => ['class' => 'phoneSN'],));
        PSFormUtils::addComment($builder);
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
        ;
        if ($personType == 'mother') {
            $builder->add($personType.'_new', MotherType::class  ,  array('required' => false, 'label' => false, 'mapped' => false,));
        } else if ($personType == 'father') {
            $builder->add($personType.'_new', FatherType::class  ,  array('required' => false, 'label' => false, 'mapped' => false,));
        }
            
        
    }
    
    public function buildEditSaveButtonByParam(FormBuilderInterface $builder, $param)
    {
        $editButtonName = 'edit'.ucfirst($param);
        $saveButtonName = 'save'.ucfirst($param);
        
        $builder
            ->add($saveButtonName , SubmitType::class, array('label' => 'save'))
            ->add($editButtonName, SubmitType::class, array('label' => 'edit'))
        ;
    }
    
    public function buildTextareaFormByParam(FormBuilderInterface $builder, $param, $label=null)
    {
        if($label == null) { $label=$param; }
        
        $builder->add($param, TextareaType::class, ['required' => false, 'label' => $label]);
        PSFormUtils::buildEditSaveButtonByParam($builder, $param);
    }
}
