<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
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

    /**
     * Shows registration form
     *
     * @Route("/register", name="account_register")
     * 
     * @return Response
     */
    public function register(){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
