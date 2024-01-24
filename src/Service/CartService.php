<?php
namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;


class CartService
{
    private $session;
    private $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack->getCurrentRequest()->getSession();
        $this->productRepository = $productRepository;
    }

    public function addProduct(int $productId)
    {
        $cart = $this->session->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }
        $this->session->set('cart', $cart);
    }

    public function removeProduct(int $productId)
    {
        $cart = $this->session->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        $this->session->set('cart', $cart);
    }

    public function increaseQuantity(int $productId)
    {
        $cart = $this->session->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        }
        $this->session->set('cart', $cart);
    }

    public function decreaseQuantity(int $productId)
    {
        $cart = $this->session->get('cart', []);
        if (isset($cart[$productId]) && $cart[$productId] > 1) {
            $cart[$productId]--;
        } else {
            unset($cart[$productId]);
        }
        $this->session->set('cart', $cart);
    }

    public function getCartDetails()
    {
        $cart = $this->session->get('cart', []);
        $data = [];
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);
            if ($product) {
                $data[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
                $totalPrice += (($product->getPrice() / 100) - (($product->getPrice() / 100) * ($product->getDiscount() / 100))) * $quantity;
                $totalQuantity += $quantity;
            }
        }

        return [
            'data' => $data,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ];
    }
}