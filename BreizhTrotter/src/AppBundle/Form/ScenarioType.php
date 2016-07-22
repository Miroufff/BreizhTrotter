<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 21/04/16
 * Time: 16:03
 */

namespace AppBundle\Form;


use AppBundle\Entity\Activity;
use Doctrine\ORM\EntityRepository;
use Sonata\ClassificationBundle\Model\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScenarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label'=>"Titre du scénario"))
            ->add('zone')
            ->add('content', 'text', array('label'=>"Contenu"))
            ->add('author', 'text', array('label'=>"Auteur"))
            ->add('date', 'date')
            ->add('description', 'textarea')
            ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Scenario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_scenario';
    }
}
