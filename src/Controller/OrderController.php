<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    #[Route('/order/checkout', name: 'app_order_checkout')]
    public function checkout(): Response
    {
        if (!$this->isGranted('ROLE_USER') && !$this->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException('Vous devez être connecté en tant qu\'utilisateur ou administrateur pour passer une commande');
}
        return $this->render('order/checkout.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
