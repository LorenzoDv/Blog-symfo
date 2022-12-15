<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        // POUR JETER UNE EXCEPTION
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', null , "accès interdit");

        if(!$user){
            $this->addFlash('danger', 'vous devez être connecté');
            return $this->redirectToRoute('home');
        }
        if($this->isGranted('ROLE_USER')){
            $this->addFlash('danger', 'vous n\'êtes pas admin');
            return $this->redirectToRoute('home');
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
