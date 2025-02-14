<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des commentaires signalés');
    }

    public function configureActions(Actions $actions): Actions
    {
        $approveAction = Action::new("approve")
        ->setLabel("Approuver & supprimer commentaire")
        ->linkToCrudAction("approveAction");

        $deApproveAction = Action::new("deApprove")
            ->setLabel("Désaprouver signalement")
            ->linkToCrudAction("deApproveAction");

        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, $approveAction)
            ->add(Crud::PAGE_INDEX, $deApproveAction)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $queryBuilder->andWhere('entity.reported = true');
        return $queryBuilder;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextEditorField::class::new('content',  "Content du commentiare"),
            DateTimeField::new('createdAt', "Date de création")
                ->setFormat("dd/MM/Y à H:m"),
            AssociationField::new("user", "Auteur du commentaire")
        ];
    }

    public function approveAction(AdminContext $adminContext,  EntityManagerInterface $entityManager,  AdminUrlGenerator $adminUrlGenerator) {
        $comment = $adminContext->getEntity()->getInstance();
        $entityManager->remove($comment);
        $entityManager->flush();

        $this->addFlash("success", "Commentaire supprimé");
        $url = $adminUrlGenerator
            ->setController(CommentCrudController::class)
            ->setAction(Crud::PAGE_INDEX)
            ->generateUrl();
        return $this->redirect($url);
    }

    public function deApproveAction(AdminContext $adminContext,  EntityManagerInterface $entityManager,  AdminUrlGenerator $adminUrlGenerator) {
        $comment = $adminContext->getEntity()->getInstance();
        $comment->setReported(false);
        $entityManager->persist($comment);
        $entityManager->flush();

        $this->addFlash("success", "Signalement désapprouvé");
        $url = $adminUrlGenerator
            ->setController(CommentCrudController::class)
            ->setAction(Crud::PAGE_INDEX)
            ->generateUrl();
        return $this->redirect($url);
    }

}
