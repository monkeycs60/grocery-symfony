<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/category/{name}', name: 'app_category')]
public function category(string $name, CategoryRepository $categoryRepository): Response
{
    // Utilisez la méthode personnalisée du repository pour obtenir les produits
        $products = $categoryRepository->findProductsByCategoryAndSubcategories($name);

        // Si aucun produit n'est trouvé, cela signifie que la catégorie n'existe pas ou qu'elle n'a pas de produits
        if (!$products) {
            throw $this->createNotFoundException('La catégorie demandée n\'existe pas ou n\'a pas de produits');
        }

         $category = $categoryRepository->findByName($name);
    
        if (!$category) {
        throw $this->createNotFoundException('La catégorie demandée n\'existe pas');
        }

    return $this->render('category/index.html.twig', [
        'products' => $products,
        'category' => $category
    ]);
}
}
