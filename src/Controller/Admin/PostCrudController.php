<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('title')
            ->setRequired(true)
            ->setMaxLength(255),

            TextEditorField::new('content')
            ->setRequired(false),

            AssociationField::new ('category')
            ->setRequired(true),

            AssociationField::new ('tags')
            ->setRequired(false),

            BooleanField::new('isActive'),

            ImageField::new('image')
            ->setUploadDir('public/uploads/images')
            ->setBasePath('/uploads/images')
            ->setUploadDir('public/uploads/images'),

        ];
    }
 
}
