<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
            ->setRequired(true)
            ->setMaxLength(50)
            ->setLabel("Nom de tag"),
            AssociationField::new('posts')
            ->setRequired(false)
            ->setCrudController(PostCrudController::class)
            ->setLabel("Ajouter à des posts")
            ->setFormTypeOption('by_reference', false),
        ];
    }
}
