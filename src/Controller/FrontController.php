<?php

namespace App\Controller;
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
            $this->addFlash('success', 'Votre commentaire abien été ajouté');
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
}
