<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{
	/**
	 * Renders the login template with the given parameters. Overwrite this function in
	 * an extended controller to provide additional data for the login template.
	 *
	 * @param array $data
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function renderLogin(array $data)
	{
	    if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	        return $this->redirect('/');
	    }

	    return $this->render('FOSUserBundle:Security:login.html.twig', $data);
	}
}
