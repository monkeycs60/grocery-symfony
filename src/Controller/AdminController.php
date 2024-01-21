<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

     #[Route('/admin/products', name: 'app_admin_products')]
    public function products(): Response
    {
        return $this->render('admin/products.html.twig');
    }

     #[Route('/admin/stocks', name: 'app_admin_stocks')]
    public function stocks(): Response
    {
        return $this->render('admin/stocks.html.twig');
    }

     #[Route('/admin/categories', name: 'app_admin_categories')]
    public function categories(): Response
    {
        return $this->render('admin/categories.html.twig');
    }

      #[Route('/admin/subcategories', name: 'app_admin_subcategories')]
    public function subcategories(): Response
    {
        return $this->render('admin/subcategories.html.twig');
    }

    #[Route('/admin/users', name: 'app_admin_users')]
    public function users(EntityManagerInterface $em): Response
    {
        $userRepository = $em->getRepository(User::class);
        $users = $userRepository->findAll();
        // dd($users);
        return $this->render('admin/users.html.twig',
        [
            'users' => $users
        ]);
    }

    #[Route('/admin/users/{id}', name: 'app_admin_users_details')]
    public function userDetails(EntityManagerInterface $em, $id): Response
    {
        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        return $this->render('admin/users_details.html.twig', [
            'user' => $user
        ]);
    }
}
