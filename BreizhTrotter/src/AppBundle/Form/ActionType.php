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
            ->add('step', 'text')
            ->add('feasibility', 'choice', array(
                'choices' => array(
                    0 => 'Faible',
                    1 => 'Moyenne',
                    2 => 'Forte',
                )))
            ->add('name')
            ->add('description', 'textarea')
            ->add('budget', 'text')
            ->add('timeLimit')
            ->add('accomplishment')
            ->add('image')
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
