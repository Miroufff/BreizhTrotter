<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Activity;
use AppBundle\Form\ActivityType;

/**
 * Activity controller.
 *
 * @Route("/activity")
 */
class ActivityController extends Controller
{

    /**
     * Lists all Activity entities.
     *
     * @Route("/", name="activity")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Activity')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Activity entity.
     *
     * @Route("/create/{id}", name="activity_create")
     * @Method({"POST", "GET"})
     * @Template("AppBundle:Activity:new.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $scenario = $em->getRepository('AppBundle:Scenario')->find($id);

        $entity = new Activity();
        $entity->setScenario($scenario);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('scenario_show', array('id' => $entity->getScenario()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Activity entity.
     *
     * @param Activity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_create', array('id' => $entity->getScenario()->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Activity entity.
     *
     * @Route("/new/{id}", name="activity_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $scenario = $em->getRepository('AppBundle:Scenario')->find($id);

        $entity = new Activity();
        $entity->setScenario($scenario);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Activity entity.
     *
     * @Route("/{id}", name="activity_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $activities = $entity->getScenario()->getActivities();

        $actions = array();
        $existing = false;

        foreach ($activities as $activity) {
            foreach($activity->getActions() as $action) {
                foreach($actions as $myAction) {
                    if ($myAction->getNumero() == $action->getNumero()) {
                        $existing = true;
                    }
                }

                if (!$existing) {
                    $actions[$action->getNumero()] = $action;
                    $existing = false;
                }
            }
        }

        foreach ($entity->getActions() as $action) {
            unset($actions[$action->getNumero()]);
        }

        $constraints = array();
        $existing = false;

        foreach ($activities as $activity) {
            foreach($activity->getConstraints() as $constraint) {
                foreach($constraints as $myConstraint) {
                    if ($myConstraint->getNumero() == $constraint->getNumero()) {
                        $existing = true;
                    }
                }

                if (!$existing) {
                    $constraints[$constraint->getNumero()] = $constraint;
                    $existing = false;
                }
            }
        }

        foreach ($entity->getConstraints() as $constraint) {
            unset($constraints[$constraint->getNumero()]);
        }

        $equipments = $em->getRepository('AppBundle:Equipment')->findAll();

        foreach ($entity->getEquipments() as $index => $myEquipment) {
            foreach ($equipments as $key => $equipment) {
                if ($myEquipment->getId() == $equipment->getId()) {
                    unset($equipments[$key]);
                }
            }
        }

        $mobilities = $em->getRepository('AppBundle:Mobility')->findAll();

        foreach ($entity->getMobilities() as $index => $myMobility) {
            foreach ($mobilities as $key => $mobility) {
                if ($myMobility->getId() == $mobility->getId()) {
                    unset($mobilities[$key]);
                }
            }
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'actions'     => $actions,
            'constraints' => $constraints,
            'equipments'  => $equipments,
            'mobilities'  => $mobilities,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Activity entity.
     *
     * @Route("/{id}/edit", name="activity_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
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
    * Creates a form to edit a Activity entity.
    *
    * @param Activity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Activity $entity)
    {
        $form = $this->createForm(new ActivityType(), $entity, array(
            'action' => $this->generateUrl('activity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Activity entity.
     *
     * @Route("/{id}", name="activity_update")
     * @Method("PUT")
     * @Template("AppBundle:Activity:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Activity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('activity_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Activity entity.
     *
     * @Route("/{id}", name="activity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Activity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Activity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('activity'));
    }

    /**
     * Creates a form to delete a Activity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
