<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('numero', 'text', array('label'=>'N° Contrainte'))
            ->add('step', 'text', array('label'=>'Etape du séjour'))
            ->add('diffLevel', 'choice', array(
                'label' => "Niveau de Difficulté",
                'choices' => array(
                    2 => 'Faible',
                    1 => 'Moyenne',
                    0 => 'Forte',
                )))
            ->add('name', 'text', array('label'=>'Titre de la contrainte'))
            ->add('associateAction', 'text', array('label'=>'N° des actions associées'))
            ->add('context', 'textarea', array('label'=>'Contexte : (actions avant / après)'))
            ->add('description', 'textarea', array('label'=>'Descriptif et état actuel de la réflexion'))
            ->add('mobilityEquipment', 'textarea', array('label'=>'Moyens de mobilité et/ou équipement concernés'))
            ->add('personInCharge', 'text', array('label'=>'Acteurs impliqués'))
            ->add('diagAction', 'textarea', array('label'=>'Actions de diagnostic à conduire'))
            ->add('viabilityImpact', 'choice', array(
                'label' => "Degré d’impact sur la viabilité du séjour",
                'choices' => array(
                    2 => 'Faible',
                    1 => 'Moyenne',
                    0 => 'Forte',
                )))
            ->add('tourismImpact', 'choice', array(
                'label' => "Degré d’impact sur « l’expérience tourisme » des clients",
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
