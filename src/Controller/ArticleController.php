<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function homepage(ArticleRepository $articleRepository){
        $articles = $articleRepository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig',[
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @return Response
     */
    public function show(Article $article){
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        /*$repository = $em->getRepository(Article::class);

        $article = $repository->findOneBy(['slug' => $slug]);
        if(!$article){
            throw $this->createNotFoundException(sprintf('no article found with slug : %s', $slug));
        }*/


        return $this->render('article/show.html.twig',[
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug)
    {
        return new JsonResponse(['hearts' => rand(5,100)]);
    }
}