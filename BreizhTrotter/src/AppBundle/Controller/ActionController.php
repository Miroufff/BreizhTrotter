<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Action;
use AppBundle\Form\ActionType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Action controller.
 *
 * @Route("/action")
 */
class ActionController extends Controller
{

    /**
     * Lists all Action entities.
     *
     * @Route("/", name="action")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Action')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Action entity.
     *
     * @Route("/create/{id}", name="action_create")
     * @Method({"POST", "GET"})
     * @Template("AppBundle:Action:new.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $activity = $em->getRepository('AppBundle:Activity')->find($id);

        $entity = new Action();

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
     * Creates a form to create a Action entity.
     *
     * @param Action $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Action $entity, Activity $activity)
    {
        $form = $this->createForm(new ActionType(), $entity, array(
            'action' => $this->generateUrl('action_create', array('id' => $activity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/new/{id}", name="action_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $activity = $em->getRepository('AppBundle:Activity')->find($id);

        $entity = new Action();
        $entity->addActivities($activity);
        $form   = $this->createCreateForm($entity, $activity);

        return array(
            'entity' => $entity,
            'activity' => $activity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingActionNew/{id}", name="action_existing_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingActionNewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $action = $em->getRepository('AppBundle:Action')->find($this->get('request')->request->get('action'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $action->addActivities($activity);

        $em->persist($action);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Displays a form to create a new Action entity.
     *
     * @Route("/existingActionRemove/{id}", name="action_existing_remove")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function existingActionRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $action = $em->getRepository('AppBundle:Action')->find($this->get('request')->request->get('actionRemove'));
        $activity = $em->getRepository('AppBundle:Activity')->find($id);
        $action->removeActivities($activity);

        $em->persist($action);
        $em->flush();

        return $this->redirect($this->generateUrl('activity_show', array('id' => $activity->getId())));
    }

    /**
     * Finds and displays a Action entity.
     *
     * @Route("/download/action/{id}", name="action_download")
     * @Method("GET")
     */
    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        $html = $this->renderView('AppBundle:Action:preview.html.twig', array(
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
     * @Route("/preview/action/{id}", name="action_preview")
     * @Method("GET")
     * @Template()
     */
    public function previewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scenario entity.');
        }

        return array(
            'entity' => $entity,
            'rootDir' => $this->get('kernel')->getRootDir().'/..'
        );
    }

    /**
     * Finds and displays a Action entity.
     *
     * @Route("/{id}", name="action_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Action')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Action entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Action entity.
     *
     * @Route("/{id}/edit", name="action_edit")
     * @Method("GET")
     * @Template()
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

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
            'action' => $this->generateUrl('action_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Action entity.
     *
     * @Route("/{id}", name="action_update")
     * @Method("PUT")
     * @Template("AppBundle:Action:edit.html.twig")
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

            return $this->redirect($this->generateUrl('action_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Action entity.
     *
     * @Route("/{id}", name="action_delete")
     * @Method("DELETE")
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

        return $this->redirect($this->generateUrl('action'));
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
            ->setAction($this->generateUrl('action_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
