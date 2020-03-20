<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * Shows all users
     * 
     * @Route("/admin/users", name="admin_users_index")
     * 
     */
    public function index(UserRepository $repo)
    {

        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findAll()
        ]);
    }
}
