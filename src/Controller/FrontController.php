<?php

namespace App\Controller;
use App\Repository\PostRepository;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function actuDetail(Post $post) : Response 
    {
     
        return $this->render('front/actu_detail.html.twig', ['post'=> $post]);
    }

    #[Route('/contact', name: 'app_front_contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}
