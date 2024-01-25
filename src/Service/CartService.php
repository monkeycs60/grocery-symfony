<?php
namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $requestStack;
    private $productRepository;

    public function __construct( ProductRepository $productRepository, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->productRepository = $productRepository;
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

    public function addProduct(int $productId)
{
    $product = $this->productRepository->find($productId);
    if ($product && $product->getStockquantity() > 0) {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
        if (isset($cart[$productId])) {
            // Vérifiez si l'augmentation de la quantité ne dépasse pas le stock
            if ($cart[$productId] < $product->getStockquantity()) {
                $cart[$productId]++;
            }
        } else {
            $cart[$productId] = 1;
        }
        $session->set('cart', $cart);
    }
}

    public function removeProduct(int $productId)
    {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        $session->set('cart', $cart);
    }

    public function increaseQuantity(int $productId)
{
    $product = $this->productRepository->find($productId);
    if ($product) {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
        if (isset($cart[$productId])) {
            // Vérifiez si l'augmentation de la quantité ne dépasse pas le stock
            if ($cart[$productId] < $product->getStockquantity()) {
                $cart[$productId]++;
            }
        }
        $session->set('cart', $cart);
    }
}

    public function decreaseQuantity(int $productId)
    {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
        if (isset($cart[$productId]) && $cart[$productId] > 1) {
            $cart[$productId]--;
        } else {
            unset($cart[$productId]);
        }
        $session->set('cart', $cart);
    }

    public function emptyCart()
    {
        $session = $this->getSession();
        $session->remove('cart');
    }

    public function getTotalQuantity(): int
    {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
        $totalQuantity = 0;
        foreach ($cart as $quantity) {
            $totalQuantity += $quantity;
        }
        return $totalQuantity;
    }

    public function getCartDetails()
    {
        $session = $this->getSession();
        $cart = $session->get('cart', []);
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