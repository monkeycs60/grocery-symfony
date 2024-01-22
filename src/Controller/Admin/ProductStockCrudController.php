<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductStockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

     public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('Stock du produit')
        ->setEntityLabelInPlural('Stocks des produits')
        ->setSearchFields(['id', 'name', 'stock'])
        ->setPageTitle(Crud::PAGE_DETAIL, fn (Product $product) => (string) $product->getName());
    }

      public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setFormTypeOptions([
                'disabled' => true, // Disable the field so it cannot be edited
            ]),
            IntegerField::new('stockquantity', 'Stock Quantity'),
            // You might want to add more fields that are relevant to stock management
        ];
    }

     public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE)
            ->disable(Action::NEW)
            ;
    }
}
