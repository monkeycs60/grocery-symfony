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
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach($cart as $id => $quantity) {
            $product = $productRepository
                ->find($id);

            $data[] = [
                'product' => $product,
                'quantity' => $quantity
            ];

            $totalPrice += (($product->getPrice() / 100 ) - (($product->getPrice() / 100) * ($product->getDiscount() / 100))) * $quantity;
            $totalQuantity += $quantity;
        }


        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
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

        // On incrémente de 1 la quantité du produit
    #[Route('/cart/increase/{id}', name: 'app_cart_increase')]
    public function increase(Product $product, SessionInterface $session): Response
    {
        $id = $product->getId();
        $cart = $session->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    // On décrémente de 1 la quantité du produit
    #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease(Product $product, SessionInterface $session): Response
    {
        $id = $product->getId();
        $cart = $session->get('cart', []);

        if(isset($cart[$id]) && $cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove(Product $product, SessionInterface $session): Response
    {
        // On récupère l'id du produit
        $id = $product->getId();

        // On récupère le panier actuel
        $cart = $session->get('cart', []);

        // Si le produit est déjà dans le panier
        if(!empty($cart[$id])) {
            // On supprime le produit du panier
            unset($cart[$id]);
        }

        // On enregistre le panier mis à jour
        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }
}
