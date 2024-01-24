<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);

        // on vide le panier
        // $session->remove('cart');

        $data = [];
        $total = 0;

        foreach($cart as $id => $quantity) {
            $product = $productRepository
                ->find($id);

            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];

            $total += $product->getPrice() * $quantity;
        }

        // dd($data, $total);



        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'total' => $total,
            'cart' => $cart
           
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(Product $product, SessionInterface $session): Response
    {
        // On récupère l'id du produit
        $id = $product->getId();

        // On récupère le panier actuel
        $cart = $session->get('cart', []);

        // Si le produit est déjà dans le panier
        if(empty($cart[$id])) {
            // On ajoute le produit au panier
            $cart[$id] = 1;
        } else {
            // On incrémente la quantité
            $cart[$id]++;
        }

        // On enregistre le panier mis à jour
        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }
}
