<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
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

    /*
        #[Route('/blog', name: 'listesDesarticles')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Article::class);

        $articles= $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
*/
    #[Route('/', name: 'home')]
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Hey hey hey',
            'prenom' => 'Yohane'
        ]);
    }
/*
    #[Route('blog/{id}', name:'blog_show')]
    public function show(ManagerRegistry $doctrine, $id){
        $repo = $doctrine->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
*/

    //INJECTION DE Dépendance : pour aller plus vite avec des fonctions plus courtes parce qu'on a plus besoin
    // du manager pour trouver mon repo je trouve directement en spécifiant mon repo en paramètre de ma fonction

    #[Route('/blog', name: 'listesDesarticles')]
    public function index(ArticleRepository $repository): Response
    {
        $articles= $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /*
    #[Route('blog/{id}', name:'blog_show')]
    public function show(ArticleRepository $repo, $id){
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }

    */

    //PLUS LOIN encore grâce au param converter qui comprend que l'article dont on parle c'est l'article qui a pour id,
    //l'id indiqué dans ma route

    #[Route('blog/{id}', name:'blog_show')]
    public function show(Article $article){

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }





}
