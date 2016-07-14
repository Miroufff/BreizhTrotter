<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Scenario;
use AppBundle\Form\ScenarioType;

/**
 * Scenario controller.
 *
 * @Route("/scenario")
 */
class ScenarioController extends Controller
{

    /**
     * Lists all Scenario entities.
     *
     * @Route("/", name="scenario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Scenario')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Scenario entity.
     *
     * @Route("/", name="scenario_create")
     * @Method("POST")
     * @Template("AppBundle:Scenario:new.html.twig")
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

            return $this->redirect($this->generateUrl('scenario_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Scenario entity.
     *
     * @param Scenario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Scenario $entity)
    {
        $form = $this->createForm(new ScenarioType(), $entity, array(
            'action' => $this->generateUrl('scenario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Scenario entity.
     *
     * @Route("/new", name="scenario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Scenario();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Scenario entity.
     *
     * @Route("/{id}", name="scenario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Scenario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Scenario entity.
     *
     * @Route("/{id}/edit", name="scenario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Scenario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Scenario entity.
    *
    * @param Scenario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Scenario $entity)
    {
        $form = $this->createForm(new ScenarioType(), $entity, array(
            'action' => $this->generateUrl('scenario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Scenario entity.
     *
     * @Route("/{id}", name="scenario_update")
     * @Method("PUT")
     * @Template("AppBundle:Scenario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Scenario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('scenario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Scenario entity.
     *
     * @Route("/{id}", name="scenario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Scenario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Scenario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('scenario'));
    }

    /**
     * Creates a form to delete a Scenario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scenario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
