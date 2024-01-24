<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    // Trouve tous les produits
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    // Trouve un produit par la query dans la barre de recherche
    #[Route('/product/search', name: 'app_product_search')]
    public function search(ProductRepository $productRepository, Request $request): Response
    {
        $searchQuery = $request->query->get('query', '');

        $products = $productRepository->findBySearchQuery($searchQuery);

        return $this->render('product/search.html.twig', [
            'products' => $products,
            'searchQuery' => $searchQuery
        ]);
    }
  
    // Trouve un produit par son slug
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
