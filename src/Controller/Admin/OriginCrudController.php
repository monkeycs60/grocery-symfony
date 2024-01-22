<?php

namespace App\Controller\Admin;

use App\Entity\Origin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OriginCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Origin::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Origine')
            ->setEntityLabelInPlural('Origines')
            ->setSearchFields(['id', 'country'])
            ->setPageTitle(Crud::PAGE_DETAIL, fn (Origin $origin) => (string) $origin->getCountry());
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('country'),
        ];
    }

      public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
