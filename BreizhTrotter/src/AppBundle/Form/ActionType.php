<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('step')
            ->add('updateDate')
            ->add('feasibility')
            ->add('name')
            ->add('description')
            ->add('budget')
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
