<?php

/**
 * Created by PhpStorm.
 * User: Mirouf
 * Date: 13/07/2016
 * Time: 19:49
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Activity;
use AppBundle\Form\ActivityType;
use AppBundle\Form\ConstraintType;
use AppBundle\Form\ImageType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ScenarioAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('zone')
            ->add('content')
            ->add('date', 'date')
            ->add('description', 'textarea')
            ->add('image', new ImageType())
            ->add('activities', 'collection',
                array(
                    'type'         => new ActivityType(),
                    'allow_add'    => true,
                    'allow_delete' => true
                )
            )
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