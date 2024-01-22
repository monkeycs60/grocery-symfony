<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
        ->setSearchFields(['id', 'title', 'description', 'name', 'price', 'category'])
        ->setPageTitle(Crud::PAGE_DETAIL, fn (Product $product) => (string) $product->getName());
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('slug'),
            TextField::new('name'),
            AssociationField::new('category'),
            TextField::new('description'),
            MoneyField::new('price')
            ->setCurrency('EUR'),
            CollectionField::new('images')
            ->setEntryType(\App\Form\ImageType::class)
            ->setFormTypeOption('by_reference', false)
            ->onlyOnForms(),
            CollectionField::new('images')
            ->setTemplatePath('form/images_upload.html.twig')
            ->onlyOnDetail(),
            NumberField::new('stockquantity'),
            NumberField::new('discount'),
            AssociationField::new('qualitylabels')
            ->setFormTypeOptions([
                'by_reference' => false,
            ]),
            AssociationField::new('nutriscore'),
            AssociationField::new('origin'),
            TextField::new('volume'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
    

