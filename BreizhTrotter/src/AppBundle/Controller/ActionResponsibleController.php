<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ActionResponsible;
use AppBundle\Form\ActionResponsibleType;

/**
 * ActionResponsible controller.
 *
 */
class ActionResponsibleController extends Controller
{

    /**
     * Lists all ActionResponsible entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ActionResponsible')->findAll();

        return $this->render('AppBundle:ActionResponsible:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ActionResponsible entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ActionResponsible();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_action_responsible_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:ActionResponsible:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ActionResponsible entity.
     *
     * @param ActionResponsible $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ActionResponsible $entity)
    {
        $form = $this->createForm(new ActionResponsibleType(), $entity, array(
            'action' => $this->generateUrl('ens_action_responsible_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ActionResponsible entity.
     *
     */
    public function newAction()
    {
        $entity = new ActionResponsible();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:ActionResponsible:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ActionResponsible entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ActionResponsible')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActionResponsible entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ActionResponsible:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ActionResponsible entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ActionResponsible')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActionResponsible entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ActionResponsible:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ActionResponsible entity.
    *
    * @param ActionResponsible $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ActionResponsible $entity)
    {
        $form = $this->createForm(new ActionResponsibleType(), $entity, array(
            'action' => $this->generateUrl('ens_action_responsible_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ActionResponsible entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ActionResponsible')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActionResponsible entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_action_responsible_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:ActionResponsible:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ActionResponsible entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:ActionResponsible')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ActionResponsible entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_action_responsible'));
    }

    /**
     * Creates a form to delete a ActionResponsible entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_action_responsible_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
