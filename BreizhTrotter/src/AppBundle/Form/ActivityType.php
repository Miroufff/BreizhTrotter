<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', 'text', array('label'=>"Jour de l'étape"))
            ->add('name', 'text', array('label'=>"Nom de l'étape"))
            ->add('description', 'textarea', array('label'=>"Descriptif expérience"))
            ->add('feasibility', 'choice', array(
                'label' => 'Faisabilité',
                'choices' => array(
                    2 => 'Faible',
                    1 => 'Moyenne',
                    0 => 'Forte',
                )))
            ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_activity';
    }
}
