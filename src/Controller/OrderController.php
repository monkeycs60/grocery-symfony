<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Repository\ProductRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    #[Route('/order/checkout', name: 'app_order_checkout')]
    public function checkout(ProductRepository $productRepository, EntityManagerInterface $em): Response
    {
        if (!$this->isGranted('ROLE_USER') && !$this->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException('Vous devez être connecté en tant qu\'utilisateur ou administrateur pour passer une commande');
}

        // récupère le cart de l'utilisateur via le cart service (qui appelle la session)
        $cartDetails = $this->cartService->getCartDetails();

        // si le panier est vide, on redirige vers la page des produits
         if (empty($cartDetails['data'])) {
        $this->addFlash('warning', 'Votre panier est vide, vous ne pouvez pas passer de commande');
        return $this->redirectToRoute('app_product');
         }

        // si le panier n'est pas vide, on crée la commande
        $order = new Order();

        // On récupère l'utilisateur connecté
        $user = $this->getUser();

        // On ajoute l'utilisateur à la commande
        $order->setUser($user);

        // On ajoute la date de création de la commande
        $order->setCreatedAt(new \DateTimeImmutable());

        // On ajoute une référence à la commande
        $order->setReference(uniqid());

        // On parcourt le panier pour créer les détails de la commande
        foreach ($cartDetails['data'] as $item) {
            $orderDetail = new OrderDetail();

            $product = $item['product']; // Obtenir le produit
            $quantity = $item['quantity']; // Obtenir la quantit

            // $product = $productRepository->find($productId);
            // dd($product);

            $price = (($product->getPrice() / 100) - (($product->getPrice() / 100) * ($product->getDiscount() / 100)));
            $orderDetail->setProduct($product);
            $orderDetail->setPrice($price);
            $orderDetail->setDiscount($product->getDiscount());
            $orderDetail->setTotal($price * $quantity);
            $orderDetail->setQuantity($quantity);
            $order->addOrderDetail($orderDetail);
        }

        // On calcule le total de la commande
        $order->setTotal($cartDetails['totalPrice']);

        // On ajoute la date de mise à jour de la commande
        $order->setUpdatedAt(new \DateTimeImmutable());

        // On ajoute le statut de la commande
        $order->setStatus('En attente du choix de livraison');

        // On enregistre la commande en BDD
        $em->persist($order);

        // On vide le panier
        $this->cartService->emptyCart();

        // On enregistre la commande en BDD
        $em->flush();

        // On affiche un message de confirmation
        $this->addFlash('success', 'Votre commande a bien été enregistrée, il vous faut maintenant choisir un mode de livraison');

        return $this->render('order/checkout.html.twig', [
            'cartDetails' => $cartDetails,
            'order' => $order
        ]);
    }
}
