<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id<[0-9]+>}', name: 'article')]
    public function index($id, PostRepository  $postReposiory, CommentRepository $commentRepository, Request $request, EntityManagerInterface $em): Response
    {   
        $postById = $postReposiory->find($id);
        $comments = $commentRepository->findBy(['post' => $postById]);

            if($this->getUser()){
                $comment = new Comment($this->getUser());
                $comment->setPost($postById);

                $form = $this->createForm(CommentType::class, $comment);
                $form->handleRequest($request);


                if($form->isSubmitted()){
                    $em->persist($comment);
                    $em->flush();
                    return $this->redirectToRoute('article', ['id' => $postById->getId()]);
                }
            }
        

        return $this->render('article/index.html.twig', [
            'postById' => $postById,
            'comments' => $comments,
            'form' => $form ?? null
        ]);
    }
}
