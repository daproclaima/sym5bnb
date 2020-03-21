<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * Shows all users
     * 
     * @Route("/admin/users/{page<\d+>?1}", name="admin_users_index")
     * 
     */
    public function index(UserRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(User::class)->setLimit(5)
        ->setPage($page);
        return $this->render('admin/user/index.html.twig', [
            'pagination' => $pagination,
            'pages' => $pagination->getPages(),
            'page' => 'pages'
        ]);
    }
}
