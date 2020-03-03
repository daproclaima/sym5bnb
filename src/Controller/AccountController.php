<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Shows and deal with the user profile modification form
     *
     * @Route("/account/profile", name="account_profile")
     * @return Response
     */
    public function profile(Request $request, EntityManagerInterface $manager) {
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // normaly unecessary since the user already exists in db
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données du profil ont été enregistré avec succès"
            );
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Modifies password
     *
     * @Route("/account/password-update", name="account_password")
     * @return Response
     */
    public function updatePassword(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) {
    $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           // #1 Check oldPassword match with user's password hashed in db
           if(!$encoder->isPasswordValid($user, $passwordUpdate->getOldPassword())) {
            //    handle error
            $form->get('oldPassword')->addError( new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
           } else {
               $newPassword = $passwordUpdate->getNewPassword();
               $hash = $encoder->encodePassword($user, $newPassword);

               $user->setHash($hash);

               $manager->persist($user);
               $manager->flush();
               $this->addFlash(
                   'success',
                   "Votre mot de passe a bien été modifié !"
               );

               return $this->redirectToRoute('homepage');
           }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Shows connected user's profile
     *
     * @Route("/account", name="account_index")
     * 
     * @return Response
     */
    public function myAccount () {
        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
