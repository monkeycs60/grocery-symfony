<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
            CollectionField::new('images')
            ->setEntryType(\App\Form\ImageType::class)
            ->setFormTypeOption('by_reference', false)
            ->onlyOnForms(),
            CollectionField::new('images')
            ->setTemplatePath('form/images_upload.html.twig')
            ->onlyOnDetail(),
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
