<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, Request $request, PaginatorInterface $paginator ): Response
    {
        $products = $productRepository->findAll();
        $topDiscountedProducts = $productRepository->findTopDiscountedProducts();


        // dd($products);
        
        $productsInPage = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('home/index.html.twig', [
            'products' => $products,
            'topDiscountedProducts' => $topDiscountedProducts,
            'productsInPage' => $productsInPage,
        ]);
    }

   
}
