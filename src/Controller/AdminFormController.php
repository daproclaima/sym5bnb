<?php

namespace App\Controller;

use App\Security\AdminFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 * 
 */
class AdminFormController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/account/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
