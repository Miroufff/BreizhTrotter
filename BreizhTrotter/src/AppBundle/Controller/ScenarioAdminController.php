<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 21/06/16
 * Time: 11:06
 */

namespace AppBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ScenarioAdminController extends Controller
{
    /**
     * (non-PHPdoc)
     * @see Sonata\AdminBundle\Controller.CRUDController::createAction()
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $object = $this->updateFields($object);

        // custom method
        $this->admin->setSubject($object);

        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bindRequest($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result' => 'ok',
                        'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->get('session')->setFlash('sonata_flash_success','flash_create_success');
                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                $this->get('session')->setFlash('sonata_flash_error', 'flash_create_error');
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }
}