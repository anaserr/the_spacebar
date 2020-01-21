<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/home")
     * @return Response
     */
    public function homepage(){
        return new Response('First symfony page! Honestly I lied it\'s not ');
    }

    /**
     * @Route("/news/{slug}")
     * @return Response
     */
    public function show($slug){
        return new Response(sprintf(
            'you are reading the article : %s',
            $slug
        ));
    }
}