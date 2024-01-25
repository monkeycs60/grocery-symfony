<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Service\CartService;

// Permet d'hydrater le panier dans tous les templates twig
class CartExtension extends AbstractExtension
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getCartCount', [$this, 'getCartCount']),
        ];
    }

    public function getCartCount(): int
    {
        return $this->cartService->getTotalQuantity();
    }
}