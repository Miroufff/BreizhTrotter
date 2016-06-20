<?php
/**
 * Created by PhpStorm.
 * User: bmille
 * Date: 02/02/2016
 * Time: 09:42
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\ScenarioType;
use AppBundle\Entity\Scenario;
use AppBundle\Entity;

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

    /**
     * Displays a form to create a new Action entity.
     *
     */
    public function newAction()
    {
        $entity = new Scenario();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Scenario:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Action entity.
     *
     * @param Scenario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Scenario $entity)
    {
        $form = $this->createForm(new ScenarioType(), $entity, array(
            'action' => $this->generateUrl('ens_scenario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a new Action entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Scenario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_scenario_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Scenario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Action entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Scenario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Scenario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

?>

