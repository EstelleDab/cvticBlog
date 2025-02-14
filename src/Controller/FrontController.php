<?php

namespace App\Controller;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class FrontController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findOrderPosts(); 
    
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts, 
        ]);
    }

    #[Route('/actualites', name: 'app_front_actualites')]
    public function actu(PostRepository $postRepository): Response
    {   
        $posts = $postRepository->findOrderPosts();
        return $this->render('front/actualites.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/actualites/{id}', name: 'app_front_actu_detail')] 
    public function actuDetail(Post $post, Request $request, EntityManagerInterface $entityManager) : Response 
    { $comment= new Comment();
        $form= $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            $comment->setUser($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Votre commentaire a bien été ajouté');
            return $this->redirectToRoute('app_front_actu_detail', ['id'=> $post->getId()]);
        }
        return $this->render('front/actu_detail.html.twig', [
            'post'=> $post,
            'form'=> $form->createView(),
    ]);
    }

    #[Route('/contact', name: 'app_front_contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route("/api/comments/{id}/delete", name: "app_front_delete_comment")]
    public function deleteComment(Request $request, EntityManagerInterface $entityManager) {
        $user = $this->getUser();
        $commentId = $request->get('id');

        $comment = $entityManager->getRepository(Comment::class)->find($commentId);

        if (!$comment) {
            $this->addFlash('danger', 'Commentaire introuvable');
            return $this->redirectToRoute('app_front_actualites');
        }

        $postId = $comment->getPost()->getId();

        if (!$user || $user !== $comment->getUser()) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer ce commentaire');
            return $this->redirectToRoute('app_front_actu_detail', ['id'=> $postId]);
        }

        $entityManager->remove($comment);
        $entityManager->flush();

        $this->addFlash('success', 'Commentaire supprimé');
        return $this->redirectToRoute('app_front_actu_detail', ['id'=> $postId]);
    }

    #[Route("/api/comments/{id}/report", name: "app_front_report_comment")]
    public function reportComment(Request $request, EntityManagerInterface $entityManager) {
        $user = $this->getUser();
        $commentId = $request->get('id');

        $comment = $entityManager->getRepository(Comment::class)->find($commentId);

        if (!$comment) {
            $this->addFlash('danger', 'Commentaire introuvable');
            return $this->redirectToRoute('app_front_actualites');
        }

        $postId = $comment->getPost()->getId();

        if (!$user || $user === $comment->getUser()) {
            $this->addFlash('danger', 'Vous ne pouvez pas signaler votre propre commentaire');
            return $this->redirectToRoute('app_front_actu_detail', ['id'=> $postId]);
        }

        $comment->setReported(true);

        $entityManager->persist($comment);
        $entityManager->flush();

        $this->addFlash('success', 'Commentaire signalé');
        return $this->redirectToRoute('app_front_actu_detail', ['id'=> $postId]);
    }
}
