<?php

namespace PS\CustomerBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
    
    public static function buildAddressTypeForm(FormBuilderInterface $builder, $personType)
    {   
        
        /** Begin Address's Fields */
        $builder
            ->add($personType.'_address_action_selector', ChoiceType::class, array(
                    'label'    => 'action.selection',
                    'choices' => array(
                        'select.existing.address' => 'select',
                        'create.new.address' => 'create',
                        'no.address' => 'none'),
                    'multiple'=>false,'expanded'=>false, 'mapped'   => false
                ))
                
            
            
            ->add($personType.'_address_new',  AddressType::class,  array('required' => false, 'label' => false, 'mapped' => false,))
         ;
        /** Begin Address's Fields */
        
        
        // adding a listener to map the address listAdress Field to the mother/father when they are not null 
        // so that, when they already have an address in DB, their address will be automatically selected
        // If mother/father is null, then listAddress Field is not mapped
        // We manually set the address to the mother/father in the controller in all case. 
        // This "mapping" when it occurs is just to make address automatically selected in the list.
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1rst argument : PRE_SET_DATA : just before the data is mapped in the Form
            function(FormEvent $event) use($personType) { // 2st argument : the function that is executed
                
                $patient = $event->getData();
                               
                // important to check that the data is not null
                // because the PRE_SET_DATA is triggered at least twice,
                // And the with the first trigger, the event data is not initialised yet (it's null)
                if ($patient != null) {
                    $getParentMethod = 'get'.ucfirst($personType);
                    $patientParent = $patient->$getParentMethod();
                    
                    $addressListProperties = [
                        'class' => 'PSCustomerBundle:Address',
                        'choice_label' => 'id', 'multiple' => false, 'expanded' => true,
                        'required' => false, 'label' => false,
                        'property_path' => 'mother.address'
                    ];
                    
                    if ($patientParent == null) {
                        $addressListProperties['mapped'] = false;
                    } else {
                        $propertyPathValue = $personType . '.address';
                        $addressListProperties['property_path'] = $propertyPathValue;
                    }
                    
                    $event->getForm()->add($personType.'_address', EntityType::class, $addressListProperties );  
                }
            }
        );
    }
}
