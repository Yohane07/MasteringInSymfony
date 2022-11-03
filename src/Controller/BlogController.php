<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
/*
    Ancienne syntaxe de getDoctrine()
        #[Route('/blog', name: 'listesDesarticles')]
        public function index(): Response
        {
            $repo = $this->getDoctrine()->getRepository(Article::class);
            $articles= $repo->findAll();

            return $this->render('blog/index.html.twig', [
                'controller_name' => 'BlogController',
                'articles' => $articles
            ]);
        }
*/

    //Nouvelle syntaxe

    #[Route('/blog', name: 'listesDesarticles')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Article::class);
        $articles= $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    #[Route('/', name: 'home')]
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Hey hey hey',
            'prenom' => 'Yohane'
        ]);
    }

    #[Route('blog/{id}', name:'blog_show')]
    public function show(ManagerRegistry $doctrine, $id){
        $repo = $doctrine->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
