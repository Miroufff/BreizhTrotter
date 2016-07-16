<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Constraint;
use AppBundle\Form\ConstraintType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Constraint controller.
 *
 * @Route("/constraint")
 */
class ConstraintController extends Controller
{

    /**
     * Lists all Constraint entities.
     *
     * @Route("/", name="constraint")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Constraint')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Constraint entity.
     *
     * @Route("/create/{id}", name="constraint_create")
     * @Method({"POST", "GET"})
     * @Template("AppBundle:Constraint:new.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $activity = $em->getRepository('AppBundle:Activity')->find($id);

        $entity = new Constraint();
        $entity->addActivities($activity);

        $form = $this->createCreateForm($entity, $activity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
        }

        return array(
            'entity' => $entity,
            'activity' => $activity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Constraint entity.
     *
     * @param Constraint $entity The entity
     * @param Activity   $activity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Constraint $entity, Activity $activity)
    {
        $form = $this->createForm(new ConstraintType(), $entity, array(
            'action' => $this->generateUrl('constraint_create', array('id' => $activity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Constraint entity.
     *
     * @Route("/new/{id}", name="constraint_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $activity = $em->getRepository('AppBundle:Activity')->find($id);

        $entity = new Constraint();
        $entity->addActivities($activity);
        $form   = $this->createCreateForm($entity, $activity);

        return array(
            'entity'   => $entity,
            'activity' => $activity,
            'form'     => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingConstraintNew/{id}", name="constraint_existing_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingConstraintNewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $constraint= $em->getRepository('AppBundle:Constraint')->find($this->get('request')->request->get('constraint'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $constraint->addActivities($activity);

        $em->persist($constraint);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingConstraintRemove/{id}", name="constraint_existing_remove")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingConstraintRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $constraint= $em->getRepository('AppBundle:Constraint')->find($this->get('request')->request->get('constraintRemove'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $constraint->removeActivities($activity);

        $em->persist($constraint);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Finds and displays a Constraint entity.
     *
     * @Route("/{id}", name="constraint_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Constraint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Constraint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Constraint entity.
     *
     * @Route("/download/constraint/{id}", name="constraint_download")
     * @Method("GET")
     */
    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Constraint')->find($id);

        $html = $this->renderView('AppBundle:Constraint:preview.html.twig', array(
            'entity'  => $entity,
            'rootDir' => $this->get('kernel')->getRootDir().'/..'
        ));

        $response = new Response();
        $response->setContent($this->get('knp_snappy.pdf')->getOutputFromHtml($html,
            array(
                'orientation' => 'Landscape',
                'load-error-handling' => 'ignore',
                'enable-javascript' => true,
                'javascript-delay' => 1000,
                'no-stop-slow-scripts' => true,
                'no-background' => false,
                'lowquality' => false,
                'encoding' => 'utf-8',
                'images' => true,
                'cookie' => array(),
                'dpi' => 300,
                'image-dpi' => 300,
                'enable-external-links' => true,
                'enable-internal-links' => true
            )
        ));
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-disposition', 'filename=scenario'.$entity->getId().'.pdf');

        return $response;
    }

    /**
     * Finds and displays a Scenario entity.
     *
     * @Route("/preview/constraint/{id}", name="constraint_preview")
     * @Method("GET")
     * @Template()
     */
    public function previewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Constraint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        return array(
            'entity' => $entity,
            'rootDir' => $this->get('kernel')->getRootDir().'/..'
        );
    }

    /**
     * Displays a form to edit an existing Constraint entity.
     *
     * @Route("/{id}/edit", name="constraint_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Constraint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Constraint entity.');
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
    * Creates a form to edit a Constraint entity.
    *
    * @param Constraint $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Constraint $entity)
    {
        $form = $this->createForm(new ConstraintType(), $entity, array(
            'action' => $this->generateUrl('constraint_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Constraint entity.
     *
     * @Route("/{id}", name="constraint_update")
     * @Method("PUT")
     * @Template("AppBundle:Constraint:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Constraint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Constraint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('constraint_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Constraint entity.
     *
     * @Route("/{id}", name="constraint_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Constraint')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Constraint entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('constraint'));
    }

    /**
     * Creates a form to delete a Constraint entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('constraint_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
