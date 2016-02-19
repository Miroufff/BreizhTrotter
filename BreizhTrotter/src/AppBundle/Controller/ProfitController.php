<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Profit;
use AppBundle\Form\ProfitType;

/**
 * Profit controller.
 *
 */
class ProfitController extends Controller
{

    /**
     * Lists all Profit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Profit')->findAll();

        return $this->render('AppBundle:Profit:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Profit entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Profit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ens_profit_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Profit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Profit entity.
     *
     * @param Profit $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Profit $entity)
    {
        $form = $this->createForm(new ProfitType(), $entity, array(
            'action' => $this->generateUrl('ens_profit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Profit entity.
     *
     */
    public function newAction()
    {
        $entity = new Profit();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Profit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Profit entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Profit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Profit:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Profit entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Profit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Profit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Profit entity.
    *
    * @param Profit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Profit $entity)
    {
        $form = $this->createForm(new ProfitType(), $entity, array(
            'action' => $this->generateUrl('ens_profit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Profit entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Profit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ens_profit_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Profit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Profit entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Profit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Profit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ens_profit'));
    }

    /**
     * Creates a form to delete a Profit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_profit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
