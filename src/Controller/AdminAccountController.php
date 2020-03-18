<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * Undocumented class
 */
class AdminAccountController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
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

    /**
    * Allows admin user to log out
    * @Route("/admin/logout", name="admin_account_logout", methods={"GET"})
    * @return void
    */
    public function logout() {
        throw new \Exception('Will be intercepted before getting here');
    }
}
