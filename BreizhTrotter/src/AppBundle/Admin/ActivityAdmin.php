<?php
/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 14/07/2016
 * Time: 12:05
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Scenario;
use AppBundle\Form\ImageType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActivityAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('day')
            ->add('name')
            ->add('description')
            ->add('feasibility')
            ->add('image', new ImageType())
            ->add('scenario')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }
}