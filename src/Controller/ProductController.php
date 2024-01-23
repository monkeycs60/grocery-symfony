<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
  
     #[Route('/product/{slug}', name: 'app_product_detail')]
    public function productDetail(ProductRepository $productRepository, string $slug): Response
{
    $product = $productRepository->findOneBy(['slug' => $slug]);

    if (!$product) {
        throw $this->createNotFoundException('Le produit demandé n\'existe pas');
    }

    return $this->render('product/detail.html.twig', [
        'product' => $product
    ]);
}
}
