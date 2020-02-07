<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * Shows and manage  user connection form
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        // dump($error);
        return $this->render('account/login.html.twig', [
            "hasError" => $error !== null,
            "username" => $username
        ]);
    }


    /**
     * Allows to log out user
     *
     * 
     * @Route("/logout",name="account_logout")
     * @return void
     */
    public function logout() {
        // .. nothing
    }
}
