<?php

namespace App\Controller\Admin;

use App\Entity\QualityLabel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QualityLabelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QualityLabel::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Label qualité')
            ->setEntityLabelInPlural('Labels qualité')
            ->setSearchFields(['id', 'label'])
            ->setPageTitle(Crud::PAGE_DETAIL, fn (QualityLabel $qualityLabel) => (string) $qualityLabel->getLabel());
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
        ];
    }

      public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
