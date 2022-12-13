<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id<[0-9]+>}', name: 'article')]
    public function index($id, PostRepository  $postReposiory): Response
    {   
        $postById = $postReposiory->find($id);
        
        return $this->render('article/index.html.twig', [
            'postById' => $postById,
        ]);
    }
}
