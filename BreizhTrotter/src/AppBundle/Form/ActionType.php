<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', 'text')
            ->add('step', 'text')
            ->add('feasibility', 'choice', array(
                'choices' => array(
                    0 => 'Faible',
                    1 => 'Moyenne',
                    2 => 'Forte',
                )))
            ->add('name')
            ->add('associateConstraint')
            ->add('personInCharge')
            ->add('description', 'textarea')
            ->add('experienceTourism', 'textarea')
            ->add('sustainableMobility', 'textarea')
            ->add('mobilityEquipment', 'textarea')
            ->add('involvedActor', 'textarea')
            ->add('deliverable', 'textarea')
            ->add('budget', 'text')
            ->add('timeLimit', 'birthday', array(
                'placeholder' => 'Select a value',)
            )
            ->add('vigilancePoint', 'textarea')
            ->add('accomplishment', 'integer', array('attr' => array('min' => 0, 'max' =>100)))
            ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Action'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_action';
    }
}
