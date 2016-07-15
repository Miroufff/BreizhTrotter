<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConstraintType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('step')
            ->add('diffLevel', 'choice', array(
                'choices' => array(
                    0 => 'Faible',
                    1 => 'Moyenne',
                    2 => 'Forte',
                )))
            ->add('name')
            ->add('associateAction')
            ->add('context', 'textarea')
            ->add('description', 'textarea')
            ->add('mobilityEquipment', 'textarea')
            ->add('personInCharge')
            ->add('diagAction', 'textarea')
            ->add('viabilityImpact', 'choice', array(
                'choices' => array(
                    0 => 'Faible',
                    1 => 'Moyenne',
                    2 => 'Forte',
                )))
            ->add('tourismImpact', 'choice', array(
                'choices' => array(
                    0 => 'Faible',
                    1 => 'Moyenne',
                    2 => 'Forte',
                )))
            ->add('image', new ImageType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Constraint'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_constraint';
    }
}
