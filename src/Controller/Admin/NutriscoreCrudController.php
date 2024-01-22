<?php

namespace App\Controller\Admin;

use App\Entity\Nutriscore;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NutriscoreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nutriscore::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Nutriscore')
            ->setEntityLabelInPlural('Nutriscores')
            ->setSearchFields(['id', 'name'])
            ->setPageTitle(Crud::PAGE_DETAIL, fn (Nutriscore $nutriscore) => (string) $nutriscore->getScore());
    }
    

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('score'),
        ];
    }

      public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
