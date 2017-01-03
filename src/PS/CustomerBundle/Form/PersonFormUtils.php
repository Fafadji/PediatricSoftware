<?php

namespace PS\CustomerBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class PersonFormUtils
{

    public static function addPrimaryInfo(FormBuilderInterface $builder)
    {
        $builder
            ->add('name',           TextType::class, array('label' => 'name.required'))
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
        $builder->add('personalPhone', TextType::class, array('required' => false, 'label' => 'personal_phone'));
        PersonFormUtils::addComment($builder);
    }
    
   

}
