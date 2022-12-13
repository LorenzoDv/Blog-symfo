<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{
    #[Route('/' , name: 'home')]
    public function index(PostRepository  $postReposiory): Response
    {
        $name = 'Lorenzo';
    

        

        return $this->render('base.html.twig', [
            'name' =>  $name,
        
        ]);
    }


    #[Route('/Tous-les-articles' , name: 'Tous-les-articles')]
    public function article(PostRepository  $postReposiory): Response
    {
        $name = 'Lorenzo';
        $posts = $postReposiory->findAll();

        

        return $this->render('home/index.html.twig', [
            'name' =>  $name,
            'posts' => $posts
        ]);
    }
}
