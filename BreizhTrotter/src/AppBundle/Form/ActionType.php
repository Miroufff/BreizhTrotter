<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('numero', 'text', array('label'=>'N° Action'))
            ->add('step', 'text', array('label'=>'Etape du séjour'))
            ->add('feasibility', 'choice', array(
                'label'=>'Niveau de Faisabilité',
                'choices' => array(
                    2 => 'Faible',
                    1 => 'Moyenne',
                    0 => 'Forte',
                )))
            ->add('name', 'text', array('label'=>'Titre de l’action'))
            ->add('associateConstraint', 'text', array('label'=>'N° des contraintes associées'))
            ->add('personInCharge', 'text', array('label'=>'Responsable(s) de l’action'))
            ->add('description', 'textarea', array('label'=>'Descriptif et état actuel de la réflexion'))
            ->add('experienceTourism', 'textarea', array('label'=>'Bénéfices « Expérience Tourisme »'))
            ->add('sustainableMobility', 'textarea', array('label'=>'Bénéfices « Mobilité durable »'))
            ->add('mobilityEquipment', 'textarea', array('label'=>'Moyens de mobilité et/ou équipement concernés'))
            ->add('involvedActor', 'textarea', array('label'=>'Acteurs impliqués'))
            ->add('deliverable', 'textarea', array('label'=>'Livrables'))
            ->add('budget', 'text', array('label'=>'Budget'))
            ->add('timeLimit', 'birthday',
                array(
                    'label'       => 'Délai',
                    'placeholder' => 'Select a value'
                )
            )
            ->add('vigilancePoint', 'textarea', array('label'=>'Points de vigilance'))
            ->add('accomplishment', 'integer',
                array(
                    'label' => 'Taux d’accomplissement de l’action',
                    'attr'  => array('min' => 0, 'max' =>100)
                )
            )
            ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
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
