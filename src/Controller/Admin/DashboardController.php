<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Nutriscore;
use App\Entity\Origin;
use App\Entity\Product;
use App\Entity\QualityLabel;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // render sidebar
            ->setTitle('Grocery Symfony')
            ->renderContentMaximized()
            ->renderSidebarMinimized();
    }

    public function configureMenuItems(): iterable
    {
       yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
       yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
       yield MenuItem::linkToCrud('Produits', 'fas fa-shopping-basket', Product::class)
       ->setController(ProductCrudController::class);
       yield MenuItem::linkToCrud('Stocks', 'fas fa-boxes', Product::class)
         ->setController(ProductStockCrudController::class);
       yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
       yield MenuItem::linkToCrud('Origine', 'fas fa-globe-europe', Origin::class);
       yield MenuItem::linkToCrud('Label qualité', 'fas fa-certificate', QualityLabel::class);
       yield MenuItem::linkToCrud('Nutriscore', 'fas fa-utensils', Nutriscore::class);
       yield MenuItem::linkToUrl('Retour au site', 'fas fa-home', '/');   
       yield MenuItem::linkToLogout('Se déconnecter', 'fa-solid fa-arrow-right-from-bracket');
       
    }
}
