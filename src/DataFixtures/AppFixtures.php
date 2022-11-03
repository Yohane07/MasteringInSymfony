<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1 ; $i <= 10; $i++){
            $article = new Article();
            $article->setTitle("Article n°$i");
            $article->setContent("<p>Description de l'article n°$i</p>");
            $article->setImage("https://via.placeholder.com/350.png/DAD0D8/?text=by+m-yohane");
            $article->setCreatedAt(new \DateTime());

            $manager->persist($article);
        }
        $manager->flush();
    }
}
