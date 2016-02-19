<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Action;
use AppBundle\Form\ActionType;

/**
 * Action controller.
 *
 */
class ActionController extends Controller
{

    /**
     * Lists all Action entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Action')->findAll();

        return $this->render('AppBundle:Action:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Action entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Action();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_action_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Action:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Action entity.
     *
     * @param Action $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Action $entity)
    {
        $form = $this->createForm(new ActionType(), $entity, array(
            'action' => $this->generateUrl('ens_action_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Action entity.
     *
     */
    public function newAction()
    {
        $entity = new Action();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Action:new.html.twig', array(
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

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Action entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Action:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Action entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Action entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Action:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Action entity.
    *
    * @param Action $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Action $entity)
    {
        $form = $this->createForm(new ActionType(), $entity, array(
            'action' => $this->generateUrl('ens_action_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Action entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Action entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_action_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Action:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Action entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Action')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Action entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_action'));
    }

    /**
     * Creates a form to delete a Action entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_action_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
