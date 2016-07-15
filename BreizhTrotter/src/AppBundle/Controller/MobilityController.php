<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Mobility;
use AppBundle\Form\MobilityType;

/**
 * Mobility controller.
 *
 * @Route("/mobility")
 */
class MobilityController extends Controller
{

    /**
     * Lists all Mobility entities.
     *
     * @Route("/", name="mobility")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Mobility')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Mobility entity.
     *
     * @Route("/", name="mobility_create")
     * @Method("POST")
     * @Template("AppBundle:Mobility:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mobility();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mobility_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mobility entity.
     *
     * @param Mobility $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mobility $entity)
    {
        $form = $this->createForm(new MobilityType(), $entity, array(
            'action' => $this->generateUrl('mobility_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Mobility entity.
     *
     * @Route("/new", name="mobility_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mobility();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingMobilityNew/{id}", name="mobility_existing_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingMobilityNewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $mobility = $em->getRepository('AppBundle:Mobility')->find($this->get('request')->request->get('mobility'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $mobility->addActivities($activity);

        $em->persist($mobility);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingMobilityRemove/{id}", name="mobility_existing_remove")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingMobilityRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $mobility = $em->getRepository('AppBundle:Mobility')->find($this->get('request')->request->get('mobilityRemove'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $mobility->removeActivities($activity);

        $em->persist($mobility);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Finds and displays a Mobility entity.
     *
     * @Route("/{id}", name="mobility_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mobility')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mobility entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mobility entity.
     *
     * @Route("/{id}/edit", name="mobility_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mobility')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mobility entity.');
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
    * Creates a form to edit a Mobility entity.
    *
    * @param Mobility $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mobility $entity)
    {
        $form = $this->createForm(new MobilityType(), $entity, array(
            'action' => $this->generateUrl('mobility_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Mobility entity.
     *
     * @Route("/{id}", name="mobility_update")
     * @Method("PUT")
     * @Template("AppBundle:Mobility:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mobility')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mobility entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mobility_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mobility entity.
     *
     * @Route("/{id}", name="mobility_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Mobility')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mobility entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mobility'));
    }

    /**
     * Creates a form to delete a Mobility entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mobility_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
