<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // On affiche le panier
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        $cartDetails = $this->cartService->getCartDetails();
        return $this->render('cart/index.html.twig', $cartDetails);
        }
    

    // On ajoute le produit au panier
    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(Product $product): Response
    {
         $this->cartService->addProduct($product->getId());
        return $this->redirectToRoute('app_cart');
    }

        // On incrémente de 1 la quantité du produit
    #[Route('/cart/increase/{id}', name: 'app_cart_increase')]
    public function increase(Product $product): Response
    {
       $this->cartService->increaseQuantity($product->getId());
        return $this->redirectToRoute('app_cart');
    }

    // On décrémente de 1 la quantité du produit
    #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease(Product $product): Response
    {
        $this->cartService->decreaseQuantity($product->getId());
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove(Product $product): Response
    {
       $this->cartService->removeProduct($product->getId());
        return $this->redirectToRoute('app_cart');
    }
}
