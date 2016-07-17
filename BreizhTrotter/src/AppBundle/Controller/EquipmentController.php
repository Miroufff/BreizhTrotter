<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Equipment;
use AppBundle\Form\EquipmentType;

/**
 * Equipment controller.
 *
 * @Route("/equipment")
 */
class EquipmentController extends Controller
{

    /**
     * Lists all Equipment entities.
     *
     * @Route("/", name="equipment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Equipment')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Equipment entity.
     *
     * @Route("/", name="equipment_create")
     * @Method("POST")
     * @Template("AppBundle:Equipment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Equipment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Equipment entity.
     *
     * @param Equipment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Equipment $entity)
    {
        $form = $this->createForm(new EquipmentType(), $entity, array(
            'action' => $this->generateUrl('equipment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Equipment entity.
     *
     * @Route("/new", name="equipment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Equipment();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingEquipmentNew/{id}", name="equipment_existing_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingEquipmentNewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository('AppBundle:Equipment')->find($this->get('request')->request->get('equipment'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $equipment->addActivities($activity);

        $em->persist($equipment);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingEquipmentRemove/{id}", name="equipment_existing_remove")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingEquipmentRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $equipment = $em->getRepository('AppBundle:Equipment')->find($this->get('request')->request->get('equipmentRemove'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $equipment->removeActivities($activity);

        $em->persist($equipment);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Finds and displays a Equipment entity.
     *
     * @Route("/{id}", name="equipment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Equipment entity.
     *
     * @Route("/{id}/edit", name="equipment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
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
    * Creates a form to edit a Equipment entity.
    *
    * @param Equipment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Equipment $entity)
    {
        $form = $this->createForm(new EquipmentType(), $entity, array(
            'action' => $this->generateUrl('equipment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Equipment entity.
     *
     * @Route("/{id}", name="equipment_update")
     * @Method("PUT")
     * @Template("AppBundle:Equipment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('equipment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Equipment entity.
     *
     * @Route("/{id}", name="equipment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Equipment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('equipment'));
    }

    /**
     * Creates a form to delete a Equipment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer'))
            ->getForm()
        ;
    }
}
