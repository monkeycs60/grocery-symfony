<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('Produit')
        ->setEntityLabelInPlural('Produits')
        ->setSearchFields(['id', 'title', 'description']);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('slug'),
            TextField::new('name'),
            TextField::new('description'),
            NumberField::new('price'),
            TextField::new('imageFile')
            ->setFormType(\Vich\UploaderBundle\Form\Type\VichImageType::class)->onlyWhenCreating()
            ,
            ImageField::new('imageName')
                ->setBasePath('/images/products')->onlyOnIndex(),
            TextField::new('category'),
            TextField::new('subcategory'),
            NumberField::new('stockquantity'),
            NumberField::new('discount'),
            ArrayField::new('qualitylabels'),
            TextField::new('nutriscore'),
            TextField::new('origin'),
            TextField::new('volume'),
        ];
    }
    
}
