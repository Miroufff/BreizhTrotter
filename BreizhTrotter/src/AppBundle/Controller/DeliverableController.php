<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Deliverable;
use AppBundle\Form\DeliverableType;

/**
 * Deliverable controller.
 *
 */
class DeliverableController extends Controller
{

    /**
     * Lists all Deliverable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Deliverable')->findAll();

        return $this->render('AppBundle:Deliverable:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Deliverable entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Deliverable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_deliverable_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Deliverable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Deliverable entity.
     *
     * @param Deliverable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Deliverable $entity)
    {
        $form = $this->createForm(new DeliverableType(), $entity, array(
            'action' => $this->generateUrl('ens_deliverable_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Deliverable entity.
     *
     */
    public function newAction()
    {
        $entity = new Deliverable();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Deliverable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Deliverable entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deliverable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deliverable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Deliverable:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Deliverable entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deliverable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deliverable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Deliverable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Deliverable entity.
    *
    * @param Deliverable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Deliverable $entity)
    {
        $form = $this->createForm(new DeliverableType(), $entity, array(
            'action' => $this->generateUrl('ens_deliverable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Deliverable entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Deliverable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Deliverable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_deliverable_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Deliverable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Deliverable entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Deliverable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Deliverable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_deliverable'));
    }

    /**
     * Creates a form to delete a Deliverable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_deliverable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
