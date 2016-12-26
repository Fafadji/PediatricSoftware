<?php

namespace PS\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class PersonType extends AbstractType
{

    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',           TextType::class, array('label' => 'name'))
            ->add('surname',        TextType::class,  array('required' => false, 'label' => 'surname'))
            ->add('birthday',       BirthdayType::class,  
                array(
                    'label' => 'birthday',
                    'required' => false,
                    'format' => 'dd MM yyyy',
                    ))
            ->add('personalPhone',  TextType::class,  array('required' => false, 'label' => 'personal_phone'))
            ->add('comment',        TextType::class,  array('required' => false, 'label' => 'comment'))

          ;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\CustomerBundle\Entity\Person'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ps_customerbundle_person';
    }


}
