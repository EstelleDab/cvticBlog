<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route("/default", name: "app_home_default")]
    public function index(){
        return $this->render('Default/index.html.twig');
    }
}
