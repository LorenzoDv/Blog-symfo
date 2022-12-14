<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{


    #[Route('/' , name: 'home')]
    public function index(): Response
    {
        $name = 'Lorenzo';
        return $this->render('base.html.twig', [
            'name' =>  $name,
        ]);
    }


    #[Route('/Tous-les-articles' , name: 'Tous-les-articles')]
    public function article(PostRepository  $postReposiory, CategoryRepository $CategoryRepository): Response
    {
        $name = 'Lorenzo';
        $posts = $postReposiory->findAll();
        $category = $CategoryRepository->findAll();

        

        return $this->render('home/index.html.twig', [
            'name' =>  $name,
            'posts' => $posts,
            'category' => $category
        ]);
    }
    
    #[Route('/Tous-les-articles/category/{id<[0-9]+>}', name:'index_by_category')]
    public function indexByCategory(Category $category, CategoryRepository $CategoryRepository)

    {
          return $this->render('home/index.html.twig', [
            'posts' => $category->getPosts(),
            'category' => $CategoryRepository->findall()
        ]); 
    }
}
