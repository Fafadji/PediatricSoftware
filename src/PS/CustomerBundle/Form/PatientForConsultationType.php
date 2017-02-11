<?php

namespace PS\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use PS\CoreBundle\Form\PSFormUtils;



class PatientForConsultationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //PSFormUtils::addPrimaryInfo($builder, true);
        
       /* $builder
            ->add('sex', TextType::class,  array('required' => false, 'label' => 'patient.sex', 'disabled' =>true))
            ->add('codeSiblings', TextType::class,  array('required' => false, 'label' => 'patient.code.siblings', 'disabled' =>true))
        ;*/
        
        //PSFormUtils::addComment($builder, true);
        PSFormUtils::buildTextareaFormByParam($builder, 'personalDiseasesHistory', 'patient.personalDiseasesHistory');
        PSFormUtils::buildTextareaFormByParam($builder, 'familyDiseasesHistory', 'patient.familyDiseasesHistory');
        PSFormUtils::buildTextareaFormByParam($builder, 'vaccines', 'patient.vaccines');
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
