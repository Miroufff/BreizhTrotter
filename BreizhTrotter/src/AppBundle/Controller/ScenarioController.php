<?php
/**
 * Created by PhpStorm.
 * User: bmille
 * Date: 02/02/2016
 * Time: 09:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ScenarioController extends Controller
{
    public function addScenario(Request $request)
    {
        $scenario = new Scenario();

        $formBuilder = $this->get('form.factory')->createBuilder('form', $scenario);

        $formBuilder
            ->add('zone',        'textarea')
            ->add('name',        'text')
            ->add('date',        'date')
            ->add('author',      'text')
            ->add('description', 'textarea')
            ->add('save',        'submit')
        ;

        $form = $formBuilder->getForm();

        return $this->render('FOSUserBundle:Scenario:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

?>

